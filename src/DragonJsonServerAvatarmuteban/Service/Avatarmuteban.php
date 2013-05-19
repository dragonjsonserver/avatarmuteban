<?php
/**
 * @link http://dragonjsonserver.de/
 * @copyright Copyright (c) 2012-2013 DragonProjects (http://dragonprojects.de/)
 * @license http://license.dragonprojects.de/dragonjsonserver.txt New BSD License
 * @author Christoph Herrmann <developer@dragonprojects.de>
 * @package DragonJsonServerAvatarmuteban
 */

namespace DragonJsonServerAvatarmuteban\Service;

/**
 * Serviceklasse zur Verwaltung von Avatarmutebanns
 */
class Avatarmuteban
{
	use \DragonJsonServer\ServiceManagerTrait;
	use \DragonJsonServer\EventManagerTrait;
	use \DragonJsonServerDoctrine\EntityManagerTrait;

	/**
	 * Erstellt einen Avatarmutebann für den Avatar
	 * @param \DragonJsonServerAvatar\Entity\Avatar $avatar
	 * @param \DateTime $end
	 * @return \DragonJsonServerAvatarmuteban\Entity\Avatarmuteban
	 */
	public function createAvatarmuteban(\DragonJsonServerAvatar\Entity\Avatar $avatar, \DateTime $end)
	{
		$avatar_id = $avatar->getAvatarId();
		$avatarmuteban = $this->getAvatarmutebanByAvatarId($avatar_id, false);
		if (null === $avatarmuteban) {
			$avatarmuteban = (new \DragonJsonServerAvatarmuteban\Entity\Avatarmuteban())
				->setAvatarId($avatar_id)
				->setEnd($end);
		} else {
			$avatarmuteban->setEnd($end);
		}
		$this->getServiceManager()->get('\DragonJsonServerDoctrine\Service\Doctrine')->transactional(function ($entityManager) use ($avatarmuteban) {
			$entityManager->persist($avatarmuteban);
			$entityManager->flush();
			$this->getEventManager()->trigger(
				(new \DragonJsonServerAvatarmuteban\Event\CreateAvatarmuteban())
					->setTarget($this)
					->setAvatarmuteban($avatarmuteban)
			);
		});
		return $avatarmuteban;
	}
	
	/**
	 * Entfernt den übergebenen Avatarmutebann
	 * @param \DragonJsonServerAvatarmuteban\Entity\Avatarmuteban $avatarmuteban
	 * @return Avatarmuteban
	 */
	public function removeAvatarmuteban(\DragonJsonServerAvatarmuteban\Entity\Avatarmuteban $avatarmuteban)
	{
		$this->getServiceManager()->get('\DragonJsonServerDoctrine\Service\Doctrine')->transactional(function ($entityManager) use ($avatarmuteban) {
			$this->getEventManager()->trigger(
				(new \DragonJsonServerAvatarmuteban\Event\RemoveAvatarmuteban())
					->setTarget($this)
					->setAvatarmuteban($avatarmuteban)
			);
			$entityManager->remove($avatarmuteban);
			$entityManager->flush();
		});
	}
	
	/**
	 * Gibt den aktuellen Avatarmutebann für die AvatarID zurück
	 * @param integer $avatar_id
	 * @param boolean $throwException
	 * @return \DragonJsonServerAvatarmuteban\Entity\Avatarmuteban|null
     * @throws \DragonJsonServer\Exception
	 */
	public function getAvatarmutebanByAvatarId($avatar_id, $throwException = true)
	{
		$entityManager = $this->getEntityManager();

		$conditions = ['avatar_id' => $avatar_id];
		$avatarmuteban = $entityManager
			->getRepository('\DragonJsonServerAvatarmuteban\Entity\Avatarmuteban')
			->findOneBy($conditions);
		if (null === $avatarmuteban) {
			if ($throwException) {
				throw new \DragonJsonServer\Exception('invalid avatar_id', $conditions);
			}
			return;
		}
		if ($avatarmuteban->getEndTimestamp() < time()) {
			$this->removeAvatarmuteban($avatarmuteban);
			return;
		}
		return $avatarmuteban;
	}
}
