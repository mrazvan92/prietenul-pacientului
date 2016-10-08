<?php
/**
  * Feedback controller
  *
  * PHP version 5
  *
  * @category   PrietenulPacientului
  * @package    Default
  * @subpackage Index
  * @author     Sauciuc Dragos George <sauciucdragos@gmail.com>
  * @copyright  2011 GovItHub (http://www.govithub.ro)
  * @license    http://www.GovITHub.ro/prietenulpacientului/license Prietenul Pacientului License 1.0
  * @version    SVN: $Id$
  * @link       http://www.GovITHub.ro/prietenulpacientului
  * @since      File available since Release 1.0.1
 */

/**
  * Feedback class
  *
  * @category   PrietenulPacientului
  * @package    Default
  * @subpackage Index
  * @author     Sauciuc Dragos George <sauciucdragos@gmail.com>
  * @copyright  2011 GovItHub (http://www.govithub.ro)
  * @license    http://www.GovITHub.ro/prietenulpacientului/license Prietenul Pacientului License 1.0
  * @version    Release: @package_version@
  * @link       http://www.GovITHub.ro/prietenulpacientului
  * @since      File available since Release 1.0.1
 */
class FeedbackController extends Zend_Controller_Action
{
	public function preDispatch()
    {

    }

	/**
	 * Initialize lang translation
	 *
	 * @return null
	 */
    public function indexAction()
    {
        $authCode = $this->_request->getParam('authCode');
        if ($authCode !== null) {
            $questId = $this->startQuestionnaire($authCode);
        } else {
            $token = $this->_request->getParam('token');
            $questId = $this->_request->getParam('questId');
            if($this->testToken($token) !== true) {

            } else {

            }
        }
    }

    /**
     * startQuestionnaire
	 *
	 * @param string $authCode
     * @return string
     */
	protected function startQuestionnaire($authCode)
    {
        $quest = new Application_Model_QuestionnaireMapper();
        $questMArr = $quest->fetchAll();
        $questObj = current($questMArr);

        $sectionMap = new Application_Model_SectionsMapper();
        $sectionstMArr = $sectionMap->fetchAll("questionnaire_id = '".$questObj->getQuestionnaire_id()."'");
        $sectionObj = current($sectionstMArr);
        $date = new Zend_Date();

        $userObj = new Application_Model_Users();
        $userObj->setAuth_code($authCode);
        $userObj->setTimestamp($date->toString('YYYY-MM-dd HH:mm:ss'));
        $userObj->setIp('');
        $userMapper = new Application_Model_UsersMapper();
        $userId = $userMapper->insert($userObj);

//        $questFeedObj = new Application_Model_QuestionnaireFeedback();
//        $questFeedObj->setSection_id($sectionObj->getSection_id());
//        $questFeedObj->setQuestionnaire_id($questObj->getQuestionnaire_id());
//        $questFeedObj->setUser_id($userId);
//        $questFeedObj->setStarttime($date->toString('YYYY-MM-dd HH:mm:ss'));
//        $questFeedMapp = new Application_Model_QuestionnaireFeedbackMapper();
//        $questFeedId = $questFeedMapp->insert($questFeedObj);
//
//        return $questFeedId;
    }

    /**
     * startQuestionnaire
	 *
	 * @param string $authCode
     * @return string
     */
	protected function testToken($token)
    {
        return true;
    }

}
