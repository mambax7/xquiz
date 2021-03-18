<?php

declare(strict_types=1);

namespace XoopsModules\Quiz;

/*
 You may not change or alter any portion of this comment or credits
 of supporting developers from this source code or any supporting source code
 which is considered copyrighted (c) material of the original comment or credit authors.
 
 This program is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
*/
/**
 * Module: Quiz
 *
 * @category        Module
 * @author          XOOPS Development Team <https://xoops.org>
 * @copyright       {@link https://xoops.org/ XOOPS Project}
 * @license         GNU GPL 2 or later (https://www.gnu.org/licenses/gpl-2.0.html)
 */

use XoopsModules\Quiz;


    $moduleDirName = \basename(\dirname(__DIR__));

$permHelper = new \Xmf\Module\Helper\Permission();




        /**
         * Class QuestionsHandler
         */
class QuestionsHandler extends \XoopsPersistableObjectHandler
{

    /**
     * @var Helper
     */
    public $helper;
    
    /**
     * Constructor
     * @param null|\XoopsDatabase $db
     * @param null|\XoopsModules\Quiz\Helper $helper
     */

    public function __construct(\XoopsDatabase $db = null, $helper = null)
    {
        /** @var \XoopsModules\Quiz\Helper $this->helper */
        $this->helper = $helper;
        parent::__construct($db, 'quiz_questions', Questions::class, 'question_id', 'question_id');
    }
    
     /**
     * @param bool $isNew
     *
     * @return \XoopsObject
     */
    public function create($isNew = true)
    {
        $obj = parent::create($isNew);
        $obj->helper = $this->helper;

        return $obj;
    }
}
