<?php

namespace XoopsModules\Quiz;

/**
 * Class Answer
 */
class Answer
{
    private $aid;
    private $questId;
    private $is_correct;
    private $answer;

    /**
     * @return int
     */
    public function getAid()
    {
        return $this->aid;
    }

    /**
     * @return string
     */
    public function getAnswer()
    {
        return $this->answer;
    }

    /**
     * @return bool
     */
    public function getIs_correct()
    {
        return $this->is_correct;
    }

    /**
     * @return int
     */
    public function getQuestId()
    {
        return $this->questId;
    }

    /**
     * @param string $aid
     */
    public function setAid($aid)
    {
        $this->aid = (int)$aid;
    }

    /**
     * @param string $answer
     */
    public function setAnswer($answer)
    {
        $this->answer = $answer;
    }

    /**
     * @param bool $is_correct
     */
    public function setIs_correct($is_correct)
    {
        $this->is_correct = (int)$is_correct;
    }

    /**
     * @param int $questId
     */
    public function setQuestId($questId)
    {
        $this->questId = (int)$questId;
    }

    /**
     * Answer constructor.
     */
    public function __construct()
    {
        //TODO - Insert your code here
    }

    /**
     *  Answer destructor.
     */
    public function __destruct()
    {
        //TODO - Insert your code here
    }

    /*
     * TODO - add new answer to database
     * @Return Boolean $res
     */
    /**
     * @return bool
     */
    public function addAnswer()
    {
        if ('' == $this->is_correct) {
            $this->is_correct = '0';
        }
        global $xoopsDB;
        $sql = 'INSERT into ' . $xoopsDB->prefix('quiz_answers') . "(question_id ,is_correct ,answer) VALUES ('$this->questId', '$this->is_correct', '$this->answer');";
        $res   = $xoopsDB->query($sql);

        if (!$res) {
            return false;
        } else {
            return true;
        }
    }

    /*
     * TODO - delete qustion's answers
     * @param $questionId
     * @return bool
     */
    /**
     * @param $questionId
     * @return bool
     */
    public static function deleteAnswers($questionId)
    {
        global $xoopsDB;
        $questionId = $xoopsDB->escape($questionId);
        $sql      = 'DELETE FROM ' . $xoopsDB->prefix('quiz_answers') . " WHERE  question_id = '$questionId' ";
        $res        = $xoopsDB->query($sql);
        if (!$res) {
            return false;
        }
        return true;
    }
}
