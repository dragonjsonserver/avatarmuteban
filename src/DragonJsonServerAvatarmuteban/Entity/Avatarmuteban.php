<?php
/**
 * @link http://dragonjsonserver.de/
 * @copyright Copyright (c) 2012-2013 DragonProjects (http://dragonprojects.de/)
 * @license http://license.dragonprojects.de/dragonjsonserver.txt New BSD License
 * @author Christoph Herrmann <developer@dragonprojects.de>
 * @package DragonJsonServerAvatarmuteban
 */

namespace DragonJsonServerAvatarmuteban\Entity;

/**
 * Entityklasse eines Avatarmutebanns
 * @Doctrine\ORM\Mapping\Entity
 * @Doctrine\ORM\Mapping\Table(name="avatarmutebans")
 */
class Avatarmuteban
{
	use \DragonJsonServerDoctrine\Entity\CreatedTrait;
	use \DragonJsonServerAvatar\Entity\AvatarIdTrait;
	
	/**
	 * @Doctrine\ORM\Mapping\Id 
	 * @Doctrine\ORM\Mapping\Column(type="integer")
	 * @Doctrine\ORM\Mapping\GeneratedValue
	 **/
	protected $avatarmuteban_id;
	
	/**
	 * @Doctrine\ORM\Mapping\Column(type="datetime")
	 **/
	protected $end;
	
	/**
	 * Gibt die ID des Avatarmutebanns zurück
	 * @return integer
	 */
	public function getAvatarmutebanId()
	{
		return $this->avatarmuteban_id;
	}
	
	/**
	 * Setzt den Endzeitpunkt des Avatarmutebanns
	 * @param \DateTime $end
	 */
	public function setEnd(\DateTime $end)
	{
		$this->end = $end;
		return $this;
	}
	
	/**
	 * Setzt den Endzeitpunkt des Avatarmutebanns als Unix Timestamp
	 * @param integer $end
	 */
	public function setEndTimestamp($end)
	{
		$this->setEnd((new \DateTime())->setTimestamp($end));
		return $this;
	}
	
	/**
	 * Gibt den Endzeitpunkt des Avatarmutebanns zurück
	 * @return \DateTime
	 */
	public function getEnd()
	{
		return $this->end;
	}
	
	/**
	 * Gibt den Endzeitpunkt des Avatarmutebanns als Unix Timestamp zurück
	 * @return \DateTime
	 */
	public function getEndTimestamp()
	{
		$end = $this->getEnd();
		if (null === $end) {
			return;
		}
		return $end->getTimestamp();
	}
	
	/**
	 * Gibt die Attribute des Avatarmutebanns als Array zurück
	 * @return array
	 */
	public function toArray()
	{
		return [
			'avatarmuteban_id' => $this->getAvatarmutebanId(),
			'created' => $this->getCreatedTimestamp(),
			'avatar_id' => $this->getAvatarId(),
			'end' => $this->getEndTimestamp(),
		];
	}
}
