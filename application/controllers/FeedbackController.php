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
        $token = $this->_request->getParam('token');
        $currentStep = $this->_request->getParam('currentStep');

        if ($token === null) {
            $questId = $this->startQuestionnaire($authCode);
            $this->view->currentStep = 'firstPage';
        } else {
            $questId = $this->_request->getParam('questId');
            if ($this->testToken($token, $questId) === false) {

            }

        }

        $questFeedMapp = new Application_Model_QuestionnaireFeedbackMapper();
        $sectionMapper = new Application_Model_SectionsMapper();
        $questFeedObjArr = $questFeedMapp->fetchAll("questionnaire_feedback_id = '".$questId."'");
        $questFeedObj = current($questFeedObjArr);
        $this->view->token = $this->generateToken($questId);
        $this->view->questId = $questId;

        switch ($currentStep) {
            case 'firstPage':

                break;
            case 'selectStation':
                $this->view->currentStep = 'selectStation';

                $countyMapp = new Application_Model_CountyMapper();
                $countyArr = $this->ObjArrToArr($countyMapp->fetchAll(), array('county_id', 'county'));
                $this->view->countyArr = $countyArr;
                break;
            case 'start':
                $section = $questFeedObj->getSection_id();
                $sectionObjArr = $sectionMapper->fetchAll("questionnaire_id = '".$questFeedObj->getQuestionnaire_id()."'");
                $sectionObj = current($sectionObjArr);
                $questFeedObj->setSection_id($sectionObj->getSection_id());
                $questFeedMapp->update($questFeedObj, "questionnaire_feedback_id = '".$questId."'");
                break;
            case 'fill':
                $section = $this->_request->getParam('sectionId');
                $section = ($section + 1);
                $sectionObjArr = $sectionMapper->fetchAll("section_id = '".$section."'");
                $sectionObj = current($sectionObjArr);
                $this->saveInput($questId);
                break;
            case 'finalize':
                $this->view->currentStep = 'finalize';
                $this->saveInput($questId);
                break;
            case 'thankyou':
                $this->view->currentStep = 'thankyou';
                break;
        }

        if ($currentStep === 'fill' || $currentStep === 'start' || $currentStep === 'finalize') {
            $sectionId = $sectionObj->getSection_id();
            $this->view->currentStep = 'fill';
            $this->view->sectionId = $sectionId;
            $nextsection = ($section + 1);
            $nextSectionObjArr = $sectionMapper->fetchAll("section_id = '".$nextsection."'");
            $nextSectionObj = current($nextSectionObjArr);

            if ($nextSectionObj === false) {
                $this->view->currentStep = 'finalize';
            }

            $this->view->sectionDescription = $sectionObj->getDescription();
            $this->view->section = $sectionObj->getSection();

            $questionMapper= new Application_Model_QuestionsMapper();
            $questionArr = $this->ObjArrToArr($questionMapper->fetchAll("section_id = '".$sectionId."'"), array('question_id', 'question', 'question_type'));
            $this->view->questionsArr = $questionArr;
            $answers = array();
            foreach ($questionArr as $question) {
                $answerMapper = new Application_Model_AnswersMapper();
                $currentAns = $this->ObjArrToArr($answerMapper->fetchAll("question_id = '".$question['question_id']."'"), array('answer_id', 'answer'));
                $answers[$question['question_id']] = $currentAns;

            }

            $this->view->answers = $answers;

        }
    }

	/**
	 * Initialize lang translation
	 *
	 * @return null
	 */
    public function fillhospitalAction()
    {
        $this->_helper->layout->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);
        $county = $this->_request->getParam('county');

        $hospitalMap = new Application_Model_HospitalMapper();
        $hospitalArr = $this->ObjArrToArr($hospitalMap->fetchAll("county_id = '".$county."'"), array('hospital_id', 'hospital'));

        echo Zend_Json::encode($hospitalArr);

    }

	/**
	 * Initialize lang translation
	 *
	 * @return null
	 */
    public function fillstationAction()
    {
        $this->_helper->layout->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);
        $hospital = $this->_request->getParam('hospital');

        $stationMap = new Application_Model_StationsMapper();
        $stationArr = $this->ObjArrToArr($stationMap->fetchAll("hospital_id = '".$hospital."'"), array('station_id', 'station'));

        echo Zend_Json::encode($stationArr);

    }

	/**
	 * Initialize lang translation
	 *
	 * @return null
	 */
    public function setstationAction()
    {
        $this->_helper->layout->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);
        $station = $this->_request->getParam('station');
        $questionnaire = $this->_request->getParam('questionnaire');

        $questionnaireMapp = new Application_Model_QuestionnaireFeedbackMapper();
        $questionnaireObj = $questionnaireMapp->find($questionnaire);
        $questionnaireObj->setStation_id($station);
        $questionnaireMapp->update($questionnaireObj, "questionnaire_feedback_id = '".$questionnaire."'");
    }

	/**
	 * Initialize lang translation
	 *
	 * @return null
	 */
    public function mobilestartAction()
    {
        $this->_helper->layout->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);
        $authCode = $this->_request->getParam('authCode');
        $questId = $this->startQuestionnaire($authCode);

        $countyMapp = new Application_Model_CountyMapper();
        $countyObjArr = $countyMapp->fetchAll();
        $countyArr = array();
        foreach ($countyObjArr as $index => $countyObj) {
            $countyArr['judete'][$index]['id'] = $countyObj->getCounty_id();
            $countyArr['judete'][$index]['name'] = $countyObj->getCounty();
        }

        $countyArr['qid'] = $questId;

        echo Zend_Json_Encoder::encode($countyArr);

    }

	/**
	 * Initialize lang translation
	 *
	 * @return null
	 */
    public function mobilehospitalAction()
    {

        $this->_helper->layout->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);
        $qid = $this->_request->getParam('qid');
        $county = $this->_request->getParam('judetId');

        $hospitalMap = new Application_Model_HospitalMapper();
        $hospitalObjArr = $hospitalMap->fetchAll("county_id = '".$county."'");
        $hospitalArr = array();
        foreach ($hospitalObjArr as $index => $hospitalObj) {
            $hospitalArr['spitale'][$index]['id'] = $hospitalObj->getHospital_id();
            $hospitalArr['spitale'][$index]['name'] = $hospitalObj->getHospital();
        }

        $hospitalArr['qid'] = $qid;

        echo Zend_Json::encode($hospitalArr);


    }

    /**
     * startQuestionnaire
	 *
	 * @param string $authCode
     * @return string
     */
	protected function saveInput($questFeedId)
    {
        $answerArr = $this->_request->getParam('answer');
        $questFeedDetailsMapper = new Application_Model_QuestionnaireFeedbackDetailsMapper();
        foreach ($answerArr as $qid => $answer) {
            $questFeedDetailsObj = new Application_Model_QuestionnaireFeedbackDetails();
            $questFeedDetailsObj->setQuestionnaire_feedback_id($questFeedId);
            $questFeedDetailsObj->setQuestion_id($qid);
            $questFeedDetailsObj->setAnswer($answer);

            $questFeedDetailsMapper->insert($questFeedDetailsObj);
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
        $date = new Zend_Date();

        $userObj = new Application_Model_Users();
        $userObj->setAuth_code($authCode);
        $userObj->setTimestamp($date->toString('YYYY-MM-dd HH:mm:ss'));
        $userObj->setIp('');
        $userMapper = new Application_Model_UsersMapper();
        $userId = $userMapper->insert($userObj);

        $questFeedObj = new Application_Model_QuestionnaireFeedback();
        $questFeedObj->setQuestionnaire_id($questObj->getQuestionnaire_id());
        $questFeedObj->setUser_id($userId);
        $questFeedObj->setStarttime($date->toString('YYYY-MM-dd HH:mm:ss'));
        $questFeedMapp = new Application_Model_QuestionnaireFeedbackMapper();
        $questFeedId = $questFeedMapp->insert($questFeedObj);

        return $questFeedId;
    }

    /**
     * startQuestionnaire
	 *
	 * @param string $token
     * @return string
     */
	protected function testToken($token)
    {
        $qid = base64_decode($token);
        $qid = substr($qid, 8);

        return true;
    }

    /**
     * startQuestionnaire
	 *
     * @return string
     */
	protected function generateToken($qid)
    {
        return base64_encode('Ppacient'.$qid);
    }

    /**
     * startQuestionnaire
	 *
     * @return string
     */
	protected function ObjArrToArr($objArr, $neededVal)
    {
        $result = array();
        $index = 0;
        foreach ($objArr as $obj) {
            $array = $obj->toArray();
            foreach ($array as $key => $value) {
                if (in_array($key, $neededVal) === true) {
                    $result[$index][$key] = $value;
                }
            }

            $index++;
        }

        return $result;
    }

}
