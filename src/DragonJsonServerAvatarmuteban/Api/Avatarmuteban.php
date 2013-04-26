<?php
/**
 * @link http://dragonjsonserver.de/
 * @copyright Copyright (c) 2012-2013 DragonProjects (http://dragonprojects.de/)
 * @license http://license.dragonprojects.de/dragonjsonserver.txt New BSD License
 * @author Christoph Herrmann <developer@dragonprojects.de>
 * @package DragonJsonServerAvatarmuteban
 */

namespace DragonJsonServerAvatarmuteban\Api;

/**
 * API Klasse zur Verwaltung von Avatarmutebanns
 */
class Avatarmuteban
{
	use \DragonJsonServer\ServiceManagerTrait;
	
	/**
	 * Gibt den Avatarmutebann für den aktuellen Avatar zurück
	 * @return array|null
	 * @DragonJsonServerAccount\Annotation\Session
	 * @DragonJsonServerAvatar\Annotation\Avatar
	 */
	public function getAvatarmuteban()
	{
		$serviceManager = $this->getServiceManager();

		$avatar = $serviceManager->get('Avatar')->getAvatar();
		$avatarmuteban = $serviceManager->get('Avatarmuteban')->getAvatarmutebanByAvatarId($avatar->getAvatarId(), false);
		if (null !== $avatarmuteban) {
			$avatarmuteban = $avatarmuteban->toArray();
		}
		return $avatarmuteban;
	}
}
