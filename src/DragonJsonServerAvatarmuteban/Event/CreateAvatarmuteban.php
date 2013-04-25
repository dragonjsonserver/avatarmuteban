<?php
/**
 * @link http://dragonjsonserver.de/
 * @copyright Copyright (c) 2012-2013 DragonProjects (http://dragonprojects.de/)
 * @license http://license.dragonprojects.de/dragonjsonserver.txt New BSD License
 * @author Christoph Herrmann <developer@dragonprojects.de>
 * @package DragonJsonServerAvatarmuteban
 */

namespace DragonJsonServerAvatarmuteban\Event;

/**
 * Eventklasse für die Erstellung eines Avatarmutebanns
 */
class CreateAvatarmuteban extends \Zend\EventManager\Event
{
	/**
	 * @var string
	 */
	protected $name = 'createavatarmuteban';

    /**
     * Setzt den Avatarmutebann der erstellt wurde
     * @param \DragonJsonServerAvatarmuteban\Entity\Avatarmuteban $avatarmuteban
     * @return CreateAvatarmuteban
     */
    public function setAvatarmuteban(\DragonJsonServerAvatarmuteban\Entity\Avatarmuteban $avatarmuteban)
    {
        $this->setParam('avatarmuteban', $avatarmuteban);
        return $this;
    }

    /**
     * Gibt den Avatarmutebann der erstellt wurde zurück
     * @return \DragonJsonServerAvatarmuteban\Entity\Avatarmuteban
     */
    public function getAvatarmuteban()
    {
        return $this->getParam('avatarmuteban');
    }
}
