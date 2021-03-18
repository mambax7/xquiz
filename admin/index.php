<?php

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

use Xmf\Module\Admin;
use Xmf\Request;
use Xmf\Yaml;
use XoopsModules\Quiz\{
    Common,
    Common\TestdataButtons,
    Forms,
    Helper,
    Utility
};

/** @var Admin $adminObject */
/** @var Helper $helper */
/** @var Utility $utility */

require_once __DIR__ . '/admin_header.php';
xoops_cp_header();
$adminObject = Admin::getInstance();

///** @var \XoopsPersistableObjectHandler $answersHandler */
//$answersHandler = $helper->getHandler('Answer');
///** @var \XoopsPersistableObjectHandler $categoriesHandler */
//$categoriesHandler = $helper->getHandler('Categories');
///** @var \XoopsPersistableObjectHandler $questionHandler */
//$questionHandler = $helper->getHandler('Question');
///** @var \XoopsPersistableObjectHandler $questionsHandler */
//$questionsHandler = $helper->getHandler('Questions');
///** @var \XoopsPersistableObjectHandler $quizHandler */
//$quizHandler = $helper->getHandler('Quiz');
//
//
////$totalQuestion = $questionHandler->getCount();
////count "total Quiz"
///** @var \XoopsPersistableObjectHandler $quizHandler */
//$totalQuiz = $quizHandler->getCount();
////count "total Cat"
///** @var \XoopsPersistableObjectHandler $categoriesHandler */
//$totalCat = $categoriesHandler->getCount();
////$totalQuiz_users = $quiz_usersHandler->getCount();
////count "total Question_user"
///** @var \XoopsPersistableObjectHandler $questionHandler */
//$totalQuestion_user = $questionHandler->getCount();
////count "total Questions"
///** @var \XoopsPersistableObjectHandler $questionsHandler */
//$totalQuestions = $questionsHandler->getCount();
////count "total Answers"
///** @var \XoopsPersistableObjectHandler $answersHandler */
//$totalAnswers = $answersHandler->getCount();
//// InfoBox Statistics
//$adminObject->addInfoBox(AM_QUIZ_STATISTICS);

//// InfoBox question
//$adminObject->addInfoBoxLine(sprintf(AM_QUIZ_THEREARE_QUESTION, $totalQuestion));
//
//// InfoBox quiz
//$adminObject->addInfoBoxLine(sprintf(AM_QUIZ_THEREARE_QUIZ, $totalQuiz));
//
//// InfoBox cat
//$adminObject->addInfoBoxLine(sprintf(AM_QUIZ_THEREARE_CATEGORY, $totalCat));
//
//// InfoBox quiz_users
//$adminObject->addInfoBoxLine(sprintf(AM_QUIZ_THEREARE_USERS, $totalQuiz_users));
//
//// InfoBox question_user
//$adminObject->addInfoBoxLine(sprintf(AM_QUIZ_THEREARE_QUESTIONUSER, $totalQuestion_user));
//
//// InfoBox questions
//$adminObject->addInfoBoxLine(sprintf(AM_QUIZ_THEREARE_QUESTIONS, $totalQuestions));
//
//// InfoBox answers
//$adminObject->addInfoBoxLine(sprintf(AM_QUIZ_THEREARE_ANSWERS, $totalAnswers));

//------ check Upload Folders ---------------
$adminObject->addConfigBoxLine('');
$redirectFile = $_SERVER['SCRIPT_NAME'];

$configurator  = new Common\Configurator();
$uploadFolders = $configurator->uploadFolders;

foreach (array_keys($uploadFolders) as $i) {
    $adminObject->addConfigBoxLine(Common\DirectoryChecker::getDirectoryStatus($uploadFolders[$i], 0777, $redirectFile));
}
//==========================================

//count "total Quizzes"
/** @var \XoopsPersistableObjectHandler $quizzesHandler */
$totalQuizzes = $quizzesHandler->getCount();
//count "total Categories"
/** @var \XoopsPersistableObjectHandler $categoriesHandler */
$totalCategories = $categoriesHandler->getCount();
//count "total Scores"
/** @var \XoopsPersistableObjectHandler $scoresHandler */
$totalScores = $scoresHandler->getCount();
//count "total Useranswers"
/** @var \XoopsPersistableObjectHandler $useranswersHandler */
$totalUseranswers = $useranswersHandler->getCount();
//count "total Questions"
/** @var \XoopsPersistableObjectHandler $questionsHandler */
$totalQuestions = $questionsHandler->getCount();
//count "total Answers"
/** @var \XoopsPersistableObjectHandler $answersHandler */
$totalAnswers = $answersHandler->getCount();

// InfoBox Statistics
$adminObject->addInfoBox(AM_QUIZ_STATISTICS);

// InfoBox quizzes
$adminObject->addInfoBoxLine(sprintf(AM_QUIZ_THEREARE_QUIZZES, $totalQuizzes));

// InfoBox categories
$adminObject->addInfoBoxLine(sprintf(AM_QUIZ_THEREARE_CATEGORY, $totalCategories));

// InfoBox scores
$adminObject->addInfoBoxLine(sprintf(AM_QUIZ_THEREARE_SCORES, $totalScores));

// InfoBox useranswers
$adminObject->addInfoBoxLine(sprintf(AM_QUIZ_THEREARE_USERANSWERS, $totalUseranswers));

// InfoBox questions
$adminObject->addInfoBoxLine(sprintf(AM_QUIZ_THEREARE_QUESTIONS, $totalQuestions));

// InfoBox answers
$adminObject->addInfoBoxLine(sprintf(AM_QUIZ_THEREARE_ANSWERS, $totalAnswers));

//==========================================

// Render Index
$adminObject->displayNavigation(basename(__FILE__));

//check for latest release
//$newRelease = $utility->checkVerModule($helper);
//if (!empty($newRelease)) {
//    $adminObject->addItemButton($newRelease[0], $newRelease[1], 'download', 'style="color : Red"');
//}


//------------- Test Data Buttons ----------------------------
if ($helper->getConfig('displaySampleButton')) {
    TestdataButtons::loadButtonConfig($adminObject);
    $adminObject->displayButton('left', '');;
}
$op = Request::getString('op', 0, 'GET');
switch ($op) {
    case 'hide_buttons':
        TestdataButtons::hideButtons();
        break;
    case 'show_buttons':
        TestdataButtons::showButtons();
        break;
}
//------------- End Test Data Buttons ----------------------------


$adminObject->displayIndex();
echo $utility::getServerStats();

//codeDump(__FILE__);
require_once __DIR__ . '/admin_footer.php';
