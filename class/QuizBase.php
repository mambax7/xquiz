<?php

namespace XoopsModules\Quiz;

/**
 * ****************************************************************************
 * quiz - MODULE FOR XOOPS
 * Copyright (c) Mojtaba Jamali of persian xoops project (http://www.irxoops.org/)
 *
 * You may not change or alter any portion of this comment or credits
 * of supporting developers from this source code or any supporting source code
 * which is considered copyrighted (c) material of the original comment or credit authors.
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 * @copyright          XOOPS Project (https://xoops.org)
 * @license            http://www.fsf.org/copyleft/gpl.html GNU public license
 * @package            quiz
 * @author             Mojtaba Jamali(jamali.mojtaba@gmail.com)
 * @version            $Id$
 *
 * Version : $Id:
 * ****************************************************************************
 */

require_once dirname(__DIR__) . '/include/common.php';
require_once XOOPS_ROOT_PATH . '/class/pagenav.php';

xoops_loadLanguage('admin', 'quiz');

/**
 * Class Quiz
 * @package XoopsModules\Quiz
 */
class QuizBase
{
    private $id;
    private $name;
    private $description;
    private $bdate;
    private $edate;
    private $btime;
    private $etime;
    private $weight;
    private $myts;
    private $categoryId;

    /**
     * quiz class constructor
     *
     */
    public function __construct()
    {
        $this->myts = \MyTextSanitizer::getInstance();
    }
    // set and get $id

    /**
     * set id class variable
     *
     * @param int $id
     * @throws \Exception
     */
    public function set_id($id)
    {
        if (!is_numeric($id)) {
            throw new \Exception('id ' . _AM_QUIZ_QUEST_NUMBER_ERROR);
        }
        $this->id = $id;
    }

    /**
     * get id class variable
     *
     * @return quizId
     * @throws \Exception
     */
    public function get_id()
    {
        if (!isset($this->id)) {
            throw new \Exception('id ' . _AM_QUIZ_QUEST_SET_ERROR);
        }
        return $this->id;
    }

    // set and get $name
    /**
     * set name class variable
     *
     * @param string $name
     */
    public function set_name($name)
    {
        $this->name = $this->myts->addSlashes($name);
    }

    /**
     * get name class variable
     *
     * @return quizName
     * @throws \Exception
     */
    public function get_name()
    {
        if (!isset($this->name)) {
            throw new \Exception('name ' . _AM_QUIZ_QUEST_SET_ERROR);
        }
        return $this->name;
    }

    // set and get $description
    /**
     * set description class variable
     *
     * @param string $description
     */
    public function set_description($description)
    {
        $this->description = $this->myts->addSlashes($description);
    }

    /**
     * get description of quiz
     *
     * @return quiz description
     * @throws \Exception
     */
    public function get_description()
    {
        if (!isset($this->description)) {
            throw new \Exception('description ' . _AM_QUIZ_QUEST_SET_ERROR);
        }
        return $this->description;
    }

    // set and get $btime
    /**
     * set begin date of quiz
     *
     * @param string $btime
     */
    public function set_btime($btime)
    {
        $this->btime = $this->myts->addSlashes($btime);
    }

    /**
     * get quiz begin date
     *
     * @return $this->btime
     * @throws \Exception
     */
    public function get_btime()
    {
        if (!isset($this->btime)) {
            throw new \Exception('btime ' . _AM_QUIZ_QUEST_SET_ERROR);
        }
        return $this->btime;
    }

    // set and get $etime
    /**
     * set end date of quiz
     *
     * @param string $etime
     */
    public function set_etime($etime)
    {
        $this->etime = $this->myts->addSlashes($etime);
    }

    /**
     * get end date of quiz
     *
     * @return $this->etime
     * @throws \Exception
     */
    public function get_etime()
    {
        if (!isset($this->etime)) {
            throw new \Exception('etime ' . _AM_QUIZ_QUEST_SET_ERROR);
        }
        return $this->etime;
    }

    // set and get $bdate
    /**
     * set begin date of quiz
     *
     * @param string $bdate
     * @throws \Exception
     */
    public function set_bdate($bdate)
    {
        //if (!preg_match("/([0-9]{4})-([0-9]{1,2})-([0-9]{1,2})/", $bdate)) {
        if (preg_match('/([0-9]{4})-([0-9]{1,2})-([0-9]{1,2})/', $bdate)) {
            throw new \Exception(_AM_QUIZ_QUEST_VALID_BDATE);
        }

        if ((isset($this->edate))
            && (strtotime($this->edate) + $this->etime <= strtotime($bdate) + $this->btime)) {
            throw new \Exception(_AM_QUIZ_QUEST_EDATE);
        }

        $t           = strtotime($this->myts->addSlashes($bdate)) + $this->btime;
        $this->bdate = date('Y-m-d G:i:s', $t);
    }

    /**
     * get quiz begin date
     *
     * @return $this->bdate
     * @throws \Exception
     */
    public function get_bdate()
    {
        if (!isset($this->bdate)) {
            throw new \Exception('bdate ' . _AM_QUIZ_QUEST_SET_ERROR);
        }
        return $this->bdate;
    }

    // set and get $edate
    /**
     * set end date of quiz
     *
     * @param string $edate
     * @throws \Exception
     */
    public function set_edate($edate)
    {
        //if (!preg_match("/([0-9]{4})-([0-9]{1,2})-([0-9]{1,2})/", $edate)) {
        if (preg_match('/([0-9]{4})-([0-9]{1,2})-([0-9]{1,2})/', $edate)) {
            throw new \Exception(_AM_QUIZ_QUEST_VALID_EDATE);
        }

        if ((isset($this->bdate))
            && (strtotime($this->bdate) + $this->btime >= strtotime($edate) + $this->etime)) {
            throw new \Exception(_AM_QUIZ_QUEST_BDATE);
        }

        $t           = strtotime($this->myts->addSlashes($edate)) + $this->etime;
        $this->edate = date('Y-m-d G:i:s', $t);
    }

    /**
     * get end date of quiz
     *
     * @return $this->edate
     * @throws \Exception
     */
    public function get_edate()
    {
        if (!isset($this->edate)) {
            throw new \Exception('edate ' . _AM_QUIZ_QUEST_SET_ERROR);
        }
        return $this->edate;
    }

    // set and get $weight
    /**
     * set weight of quiz
     *
     * @param int $weight
     * @throws \Exception
     */
    public function set_weight($weight)
    {
        if (!is_numeric($weight)) {
            throw new \Exception('weight ' . _AM_QUIZ_QUEST_NUMBER_ERROR);
        }
        $this->weight = $weight;
    }

    /**
     * get weight of quiz
     *
     * @return $this->weight
     * @throws \Exception
     */
    public function get_weight()
    {
        if (!isset($this->weight)) {
            throw new \Exception('weight ' . _AM_QUIZ_QUEST_SET_ERROR);
        }
        return $this->weight;
    }

    // set and get $id
    /**
     * set Category of quiz
     *
     * @param int $cid
     * @throws \Exception
     */
    public function set_cid($cid)
    {
        if (!is_numeric($cid)) {
            throw new \Exception('cid ' . _AM_QUIZ_QUEST_NUMBER_ERROR);
        }
        $this->categoryId = $cid;
    }

    /**
     * get category of quiz
     *
     * @return cid
     * @throws \Exception
     */
    public function get_cid()
    {
        if (!isset($this->categoryId)) {
            throw new \Exception('cid ' . _AM_QUIZ_QUEST_SET_ERROR);
        }
        return $this->categoryId;
    }


    /**
     * add new quiz into database
     * with class variable
     * @throws \Exception
     */
    public function addQuiz()
    {
        global $xoopsDB;
        $sql = 'Insert into ' . $xoopsDB->prefix('quiz_quizzes') . "(id ,name ,description ,bdate ,edate ,weight ,cid)
				VALUES (NULL , '$this->name', '$this->description', '$this->bdate', '$this->edate', '$this->weight', '$this->categoryId');";
        $res   = $xoopsDB->query($sql);

        if (!$res) {
            throw new \Exception(_AM_QUIZ_QUEST_DATABASE);
        }
    }

    /**
     * delete quiz from database
     *
     * @throws \Exception
     */
    public function deleteQuiz()
    {
        global $xoopsDB, $xoopsModule;

        $sql = 'DELETE FROM ' . $xoopsDB->prefix('quiz_quizzes') . " WHERE  
					  id = '$this->id' ";
        $res   = $xoopsDB->query($sql);
        xoops_comment_delete($xoopsModule->getVar('mid'), $this->id);

        if (!$res) {
            throw new \Exception(_AM_QUIZ_QUEST_DATABASE);
        }

        $sql = 'DELETE FROM ' . $xoopsDB->prefix('quiz_questions') . " WHERE  
					  quiz_id = '$this->id' ";
        $res   = $xoopsDB->query($sql);
        if (!$res) {
            throw new \Exception(_AM_QUIZ_QUEST_DATABASE);
        }
    }

    /**
     * edit quiz in database
     * with class vriable
     * @throws \Exception
     */
    public function editQuiz()
    {
        global $xoopsDB;
        $sql = 'UPDATE ' . $xoopsDB->prefix('quiz_quizzes') . " SET 
					  name = '$this->name'
					 ,description = '$this->description'
					 ,bdate = '$this->bdate'
					 ,edate = '$this->edate'
					 ,weight = '$this->weight'
					 ,cid = '$this->categoryId'
					 WHERE id = '$this->id' ";
        $res   = $xoopsDB->query($sql);

        if (!$res) {
            throw new \Exception(_AM_QUIZ_QUEST_DATABASE);
        }
    }

    /**
     * @return bool
     */
    public function checkExistQuiz()
    {
        global $xoopsDB;
        $sql = 'SELECT * FROM ' . $xoopsDB->prefix('quiz_quizzes') . " WHERE name LIKE '$this->name'";
        $result = $xoopsDB->query($sql);
        $res   = $xoopsDB->getRowsNum($result);

        if ($res > 0) {
            return true;
        }

        return false;
    }

    /**
     * @param $qId
     * @return array|false
     */
    public static function retrieveQuiz($qId)
    {
        global $xoopsDB;
        $sql = 'SELECT * FROM ' . $xoopsDB->prefix('quiz_quizzes') . " WHERE id = '$qId'";
        $result = $xoopsDB->query($sql);
        $myrow = $xoopsDB->fetchArray($result);
        return $myrow;
    }

    /**
     * @param string $op
     * @param int    $eId
     * @throws \Exception
     */
    public static function QuizForm($op = 'add', $eId = 0)
    {
        global $xoopsDB, $xoopsModuleConfig;
        //check for category existance
        $xt = new Category($xoopsDB->prefix('quiz_categories'), 'cid', 'pid');
        if (!$xt->getChildTreeArray(0)) {
            throw new \Exception(_AM_QUIZ_NO_CATEGORY);
        }
        $addQuiz_form = new \XoopsThemeForm(
            _AM_QUIZ_NEW, 'addquizfrom', XOOPS_URL . '/modules/quiz/admin/backend.php', 'post', true
        );

        if ('edit' == $op) {
            $quiz             = self::retrieveQuiz($eId);
            $quiz_id_v        = $quiz['id'];
            $quiz_name_v      = $quiz['name'];
            $quiz_category_id = $quiz['cid'];
            $quiz_desc_v      = $quiz['description'];
            $quiz_bdate_v     = strtotime($quiz['bdate']);
            $quiz_edate_v     = strtotime($quiz['edate']);
            $quiz_weight_v    = $quiz['weight'];
            $quiz_id          = new \XoopsFormHidden('quizId', $quiz_id_v);
            $addQuiz_form->addElement($quiz_id);
            $submit_button = new \XoopsFormButton('', 'editQuizSubmit', _AM_QUIZ_SUBMIT, 'submit');
        } elseif ('add' == $op) {
            $quiz_name_v      = '';
            $quiz_category_id = 0;
            $quiz_desc_v      = '';
            $quiz_bdate_v     = time() + (3600 * 24 * 2);
            //$quiz_bdate_v = time();
            //$quiz_edate_v = time();
            $quiz_edate_v  = time() + (3600 * 24 * 16);
            $quiz_weight_v = 0;
            $submit_button = new \XoopsFormButton('', 'addQuizSubmit', _AM_QUIZ_SUBMIT, 'submit');
        }
        $quiz_name = new \XoopsFormText(_AM_QUIZ_NAME, 'quizName', 50, 100, $quiz_name_v);
        ob_start();
        $xt->makeMySelBox('title', 'cid ASC', $quiz_category_id, 0, 'quizCategory');
        $quiz_category = new \XoopsFormLabel(_AM_QUIZ_CATEGORY, ob_get_clean());
        $quiz_begin_date = new \XoopsFormDateTime(_AM_QUIZ_BDATE, 'quizBDate', 15, $quiz_bdate_v);
        $quiz_end_date   = new \XoopsFormDateTime(_AM_QUIZ_EDATE, 'quizEDate', 15, $quiz_edate_v);
        $quiz_weight     = new \XoopsFormText(_AM_QUIZ_WEIGHT, 'quizWeight', 5, 3, $quiz_weight_v);
        //$quiz_token = new \XoopsFormHidden("XOOPS_TOKEN_REQUEST", $GLOBALS['xoopsSecurity']->createToken());

        $options_tray = new \XoopsFormElementTray(_AM_QUIZ_DESC, '<br>');
        if (class_exists('XoopsFormEditor')) {
            $options['name']   = 'quizDesc';
            $options['value']  = $quiz_desc_v;
            $options['rows']   = 25;
            $options['cols']   = '100%';
            $options['width']  = '100%';
            $options['height'] = '600px';
            $contents_contents = new \XoopsFormEditor('', $xoopsModuleConfig['editorUser'], $options, $nohtml = false, $onfailure = 'textarea');
            $options_tray->addElement($contents_contents);
        } else {
            $contents_contents = new \XoopsFormDhtmlTextArea('', 'quizDesc', $quiz_desc_v);
            $options_tray->addElement($contents_contents);
        }

        $addQuiz_form->addElement($quiz_name, true);
        $addQuiz_form->addElement($quiz_category, true);
        $addQuiz_form->addElement($options_tray, true);
        $addQuiz_form->addElement($quiz_begin_date, true);
        $addQuiz_form->addElement($quiz_end_date, true);
        $addQuiz_form->addElement($quiz_weight, true);
        // $addQuiz_form->addElement($quiz_token, true);
        $addQuiz_form->addElement($submit_button);

        Utility::collapsableBar('newquiz', 'topnewquiz');
        echo "<img onclick=\"toggle('toptable'); toggleIcon('toptableicon');\" id='topnewquiz' name='topnewquiz' src='" . XOOPS_URL . "/modules/quiz/assets/images/close12.gif' alt=''>
				 	</a>&nbsp;" . _AM_QUIZ_NEW . "</h4><br>
						<div id='newquiz' style='text-align: center;'>";
        $addQuiz_form->display();
        echo '</div>';
    }

    /**
     * @param     $start
     * @param     $limit
     * @param int $categoryId
     */
    public static function showQuizs($start, $limit, $categoryId = -1)
    {
        global $xoopsDB;
        $xt = new Category($xoopsDB->prefix('quiz_categories'), 'cid', 'pid');
        ob_start();
        $xt->makeMySelBox('title', 'cid', 0, 1, 'Id', '', 1);
        $select = ob_get_clean();

        $nume = self::quiz_numQuizLoader();

        $listQuiz = self::quiz_listQuizLoader($start, $limit, $categoryId);
        Utility::collapsableBar('newsub', 'topnewsubicon');
        $temp = "<img onclick=\"toggle('toptable'); toggleIcon('toptableicon');\" id='topnewsubicon' name='topnewsubicon' src='" . XOOPS_URL . "/modules/quiz/assets/images/close12.gif' alt=''>
				 </a>&nbsp;" . _AM_QUIZ_QUIZS . "</h4><br>
					<div id='newsub' style='text-align:left;'>
					<table width='100%' cellspacing='1' cellpadding='3' border='0' class='outer'>
						<tr class='odd'>
							<td>
							<form method='get' action='main.php'>
							<input type='hidden' name='op' value='Quiz'>
							<input type='hidden' name='act' value='add'>
							<input type='submit' value='" . _AM_QUIZ_NEW_QUIZ . "'>
							</form>
							</td>
							<td>
							<form method='get' action='main.php'\">
								<input type='hidden' name='op' value='Quiz'>
								<label>" . _AM_QUIZ_CATEGORY_SELECT . "
				 				$select
								</lable>
								<input type='submit' value='" . _AM_QUIZ_QUEST_GO . "'>
							</form>
							</td>
						</tr>
					</table>
					<table width='100%' cellspacing='1' cellpadding='3' border='0' class='outer'>
					<tr class='bg3'><thead>
						<th>
							" . _AM_QUIZ_NAME . '
						</th>
						<th>
							' . _AM_QUIZ_CATEGORY . '
						</th>
						<th>
							' . _AM_QUIZ_QUESTIONS . '
						</th>
						<th>
							' . _AM_QUIZ_STARTDATE . '
						</th>
						<th>
							' . _AM_QUIZ_ENDDATE . '
						</th>
						<th>
							' . _AM_QUIZ_STATUS . '
						</th>
						<th>
							' . _AM_QUIZ_WEIGHT . '
						</th>
						<th>
							' . _AM_QUIZ_ACTION . '
						</th>
					</tr></thead>';

        $class       = 'even';
        $onImage     = '<img src= "' . XOOPS_URL . '/modules/quiz/assets/images/on.png " >';
        $offImage    = '<img src= "' . XOOPS_URL . '/modules/quiz/assets/images/off.png " >';
        $editImage   = '<img src= "' . XOOPS_URL . '/modules/quiz/assets/images/edit.png " title="' . _AM_QUIZ_EDIT . '" alt="" >';
        $statImage   = '<img src= "' . XOOPS_URL . '/modules/quiz/assets/images/stat.png " title="' . _AM_QUIZ_STAT . '" alt="" >';
        $addImage    = '<img src= "' . XOOPS_URL . '/modules/quiz/assets/images/add.png " title="' . _AM_QUIZ_QUEST_ADD . '" alt="" >';
        $exportImage = '<img src= "' . XOOPS_URL . '/modules/quiz/assets/images/export.png " title="' . _AM_QUIZ_CSV_EXPORT . '" alt="" >';
        $delImage    = '<img src= "' . XOOPS_URL . '/modules/quiz/assets/images/delete.png " title="' . _AM_QUIZ_DEL . '" alt="" >';

        foreach ($listQuiz as $key) {
            $status = ($key['status']) ? $onImage : $offImage;
            $active = ($key['active']) ? $onImage : $offImage;
            //$statEdit = (!$key['active']) ? $statImage:$editImage;
            //$questLink = ((!$key['status'])&&($key['active']))?
            $questLink = (($key['active']))
                ? ("<a class='btn btn-primary btn-xs' href=\"" . XOOPS_URL . '/modules/quiz/admin/main.php?op=Question&act=add&Id=' . $key['id'] . '">' . _AM_QUIZ_QUEST_NEW . ' ' . $addImage . ' ' . $key['totalquestion'] . '</a>')
                : $key['totalquestion'];
            $category     = Category::retrieveCategory($key['cid']);
            $quizCategory = '<a href="' . XOOPS_URL . '/modules/quiz/index.php?cid=' . $category['cid'] . '">' . $category['title'] . '</a>';

            $class = ('even' == $class) ? 'odd' : 'even';

            $temp .= "
			<tr class='" . $class . "'>
				<td>
					<a href=\"" . XOOPS_URL . '/modules/quiz/index.php?act=v&q=' . $key['id'] . '">' . $key['name'] . '</a>
				</td>
				<td>
					' . $quizCategory . '
				</td>
				<td>
					' . $questLink . '
				</td>
				<td>
				' . $status . '  ' . $key['bdate'] . '
				</td>
				<td>
				' . $active . '  ' . $key['edate'] . '
				</td>
				<td>
				' . $key['activequiz'] . '
				</td>
				<td>
				' . $key['weight'] . '
				</td>
				<td>
				<a href="' . XOOPS_URL . '/modules/quiz/admin/main.php?op=Quiz&act=edit&Id=' . $key['id'] . '">
				' . $editImage . '
				</a>
				<a href="' . XOOPS_URL . '/modules/quiz/admin/main.php?op=Statistics&Id=' . $key['id'] . '">
				' . $statImage . '
				</a>
				<a href="' . XOOPS_URL . '/modules/quiz/admin/main.php?op=Statistics&Id=' . $key['id'] . '&exp=on">
				' . $exportImage . '
				</a>
				<a href="' . XOOPS_URL . '/modules/quiz/admin/main.php?op=Quiz&act=del&Id=' . $key['id'] . '">
				' . $delImage . '
				</a>				
				</td>
				</tr>';
        }

        $temp .= '</table></div>';
        echo $temp;
        $nav = new \XoopsPageNav($nume, $limit, $start, 'start', 'op=Quiz');
        echo "<div align='center'>" . $nav->renderImageNav() . '</div><br>';
    }

    /**
     * @param $id
     */
    public static function confirmForm($id)
    {
        $delQuiz_form  = new \XoopsThemeForm(
            _AM_QUIZ_DELQUIZFORM, 'delquizfrom', XOOPS_URL . '/modules/quiz/admin/backend.php', 'post', true
        );
        $quiz_id       = new \XoopsFormHidden('quizId', $id);
        $quiz_confirm  = new \XoopsFormRadioYN(_AM_QUIZ_DELETE_CAPTION, 'delConfirm', 0);
        $submit_button = new \XoopsFormButton('', 'delQuizSubmit', _AM_QUIZ_SUBMIT, 'submit');
        //$quiz_token = new \XoopsFormHidden("XOOPS_TOKEN_REQUEST", $GLOBALS['xoopsSecurity']->createToken());

        $delQuiz_form->addElement($quiz_id);
        //$delQuiz_form->addElement($quiz_token, true);
        $delQuiz_form->addElement($quiz_confirm, true);
        $delQuiz_form->addElement($submit_button);

        Utility::collapsableBar('newquiz', 'topnewquiz');
        echo "<img onclick=\"toggle('toptable'); toggleIcon('toptableicon');\" id='topnewquiz' name='topnewquiz' src='" . XOOPS_URL . "/modules/quiz/assets/images/close12.gif' alt=''>
				 </a>&nbsp;" . DELQUIZFORM . "</h4><br>
					<div id='newquiz' style='text-align: center;'>";
        $delQuiz_form->display();
        echo '</div>';
    }

    /**
     * @return int
     */
    public static function quiz_numQuizLoader()
    {
        global $xoopsDB;
        $sql = ' SELECT * FROM ' . $xoopsDB->prefix('quiz_quizzes');
        $result = $xoopsDB->query($sql);
        return $xoopsDB->getRowsNum($result);
    }

    /**
     * @param     $eu
     * @param     $limit
     * @param int $categoryId
     * @return array
     */
    public static function quiz_listQuizLoader($eu, $limit, $categoryId = -1)
    {
        global $xoopsDB, $xoopsModuleConfig;
        $dateformat = $xoopsModuleConfig['dateformat']??'';
        $listQuiz   = [];
        $q          = 1;
        $sql      = ' SELECT * FROM ' . $xoopsDB->prefix('quiz_quizzes');
        if ($categoryId >= 0) {
            $sql .= ' WHERE cid = ' . $categoryId;
        }
        $sql .= ' LIMIT ' . $eu . ' , ' . $limit;

        $result = $xoopsDB->query($sql);
        while (false !== ($myrow = $xoopsDB->fetchArray($result))) {
            $listQuiz[$q]['id']          = $myrow['id'];
            $listQuiz[$q]['name']        = $myrow['name'];
            $listQuiz[$q]['description'] = $myrow['description'];
            $listQuiz[$q]['cid']         = $myrow['cid'];
            $listQuiz[$q]['bdate']       = formatTimestamp(strtotime($myrow['bdate']), $dateformat);
            $listQuiz[$q]['edate']       = formatTimestamp(strtotime($myrow['edate']), $dateformat);
            $listQuiz[$q]['weight']      = $myrow['weight'];
            global $xoopsDB;
            $id                            = $myrow['id'];
            $sql = ' SELECT * FROM ' . $xoopsDB->prefix('quiz_questions') . ' WHERE quiz_id = ' . $id . '';
            $totalquestion                 = $xoopsDB->query($sql);
            $listQuiz[$q]['totalquestion'] = $xoopsDB->getRowsNum($totalquestion);

            $today = strtotime(date('Y-m-d'));

            //Show all quiz
            $listQuiz[$q]['status'] = true;
            if (strtotime($myrow['bdate']) <= $today) {
                //$listQuiz[$q]['status'] = true;
            } else {
                //$listQuiz[$q]['status'] = false;
            }

            //Quiz Running or Expired ?
            if (strtotime($myrow['bdate']) >= $today or strtotime($myrow['edate']) >= $today) {
                $listQuiz[$q]['active']     = true;
                $listQuiz[$q]['activequiz'] = _AM_QUIZ_RUNNING;
            } else {
                $listQuiz[$q]['active']     = false;
                $listQuiz[$q]['activequiz'] = _AM_QUIZ_EXPIRED;
            }

            // Quiz Ended ?
            if (strtotime($myrow['edate']) <= $today) {
                $listQuiz[$q]['viewstat'] = true;
            } else {
                $listQuiz[$q]['viewstat'] = false;
            }

            $q++;
        }
        return $listQuiz;
    }

    /**
     * @return array
     */
    public static function allQuizs()
    {
        global $xoopsDB;
        $listQuiz = [];
        $q        = 1;
        $sql = ' SELECT * FROM ' . $xoopsDB->prefix('quiz_quizzes') . ' ORDER BY id DESC';
        $result    = $xoopsDB->query($sql);
        while (false !== ($myrow = $xoopsDB->fetchArray($result))) {
            $listQuiz[$q]['id']   = $myrow['id'];
            $listQuiz[$q]['name'] = $myrow['name'];
            $q++;
        }
        return $listQuiz;
    }

    /**
     * @return array
     */
    public static function quiz_listQuizArray()
    {
        global $xoopsDB;
        $listQuiz = [];
        $sql = ' SELECT * FROM ' . $xoopsDB->prefix('quiz_quizzes') . ' ORDER BY \'bdate\' ASC';
        $result    = $xoopsDB->query($sql);
        while (false !== ($myrow = $xoopsDB->fetchArray($result))) {
            $listQuiz[$myrow['id']] = $myrow['name'];
        }
        return $listQuiz;
    }

    /**
     * @param $id
     * @return bool
     */
    public static function quiz_checkActiveQuiz($id)
    {
        global $xoopsDB;
        $sql = ' SELECT bdate FROM ' . $xoopsDB->prefix('quiz_quizzes') . ' WHERE id = ' . $id;
        $result = $xoopsDB->query($sql);
        $myrow = $xoopsDB->fetchArray($result);
        $today = strtotime(date('Y-m-d'));
        if (strtotime($myrow['bdate']) <= $today) {
            return true;
        }

        return false;
    }

    /**
     * @param $id
     * @return bool
     */
    public static function quiz_checkExpireQuiz($id)
    {
        global $xoopsDB;
        $sql = ' SELECT edate FROM ' . $xoopsDB->prefix('quiz_quizzes') . ' WHERE id = ' . $id;
        $result = $xoopsDB->query($sql);
        $myrow = $xoopsDB->fetchArray($result);
        $today = strtotime(date('Y-m-d'));
        if (strtotime($myrow['edate']) >= $today) {
            return true;
        }

        return false;
    }

    /**
     * @param $id
     * @return array
     */
    public static function quiz_quizName($id)
    {
        global $xoopsDB;
        $sql = ' SELECT name,cid,description FROM ' . $xoopsDB->prefix('quiz_quizzes') . ' WHERE id = ' . $id;
        $result    = $xoopsDB->query($sql);
        $myrow    = $xoopsDB->fetchArray($result);
        $category = Category::retrieveCategory($myrow['cid']);
        $arr      = [
            'name'        => $myrow['name'],
            'description' => $myrow['description'],
            'cid'         => $myrow['cid'],
            'category'    => $category['title'],
        ];
        return $arr;
    }

    /**
     * @param $id
     * @return mixed
     */
    public static function quizCategory($id)
    {
        global $xoopsDB;
        $sql = ' SELECT cid FROM ' . $xoopsDB->prefix('quiz_quizzes') . ' WHERE id = ' . $id;
        $result = $xoopsDB->query($sql);
        $myrow = $xoopsDB->fetchArray($result);
        return $myrow['cid'];
    }

    /**
     * @param $id
     * @return bool
     */
    public static function quiz_checkExistQuiz($id)
    {
        global $xoopsDB;
        $sql = 'SELECT * FROM ' . $xoopsDB->prefix('quiz_quizzes') . " WHERE id = '$id'";
        $result = $xoopsDB->query($sql);
        $res   = $xoopsDB->getRowsNum($result);
        if ($res > 0) {
            return true;
        }

        return false;
    }
}
