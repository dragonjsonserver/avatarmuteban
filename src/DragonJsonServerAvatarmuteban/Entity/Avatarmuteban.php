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
	 * Setzt die ID des Avatarmutebanns
	 * @param integer $avatarmuteban_id
	 * @return Avatarmuteban
	 */
	protected function setAvatarmutebanId($avatarmuteban_id)
	{
		$this->avatarmuteban_id = $avatarmuteban_id;
		return $this;
	}
	
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
	 * @return Avatarmuteban
	 */
	public function setEnd(\DateTime $end)
	{
		$this->end = $end;
		return $this;
	}
	
	/**
	 * Setzt den Endzeitpunkt des Avatarmutebanns als Unix Timestamp
	 * @param integer $end
	 * @return Avatarmuteban
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
	 * Setzt die Attribute des Avatarmutebanns aus dem Array
	 * @param array $array
	 * @return Avatarmuteban
	 */
	public function fromArray(array $array)
	{
		return $this
			->setAvatarmutebanId($array['avatarmuteban_id'])
			->setCreatedTimestamp($array['created'])
			->setAvatarId($array['avatar_id'])
			->setEndTimestamp($array['end']);
	}
	
	/**
	 * Gibt die Attribute des Avatarmutebanns als Array zurück
	 * @return array
	 */
	public function toArray()
	{
		return [
			'__className' => __CLASS__,
			'avatarmuteban_id' => $this->getAvatarmutebanId(),
			'created' => $this->getCreatedTimestamp(),
			'avatar_id' => $this->getAvatarId(),
			'end' => $this->getEndTimestamp(),
		];
	}
}
