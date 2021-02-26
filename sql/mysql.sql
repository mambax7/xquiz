CREATE TABLE quiz_quizzes (
    id          INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
    name        VARCHAR(45)      NOT NULL,
    cid         INT(10) UNSIGNED NOT NULL,
    description TEXT,
    bdate       DATETIME         NOT NULL,
    edate       DATETIME         NOT NULL,
    weight      INT(11) DEFAULT '0',
    PRIMARY KEY (id)
)
    ENGINE = InnoDB
    DEFAULT CHARSET = utf8;

CREATE TABLE quiz_categories (
    cid         INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
    pid         INT(11) UNSIGNED NOT NULL DEFAULT '0',
    title       VARCHAR(100)     NOT NULL DEFAULT '',
    imgurl      VARCHAR(255)     NOT NULL DEFAULT '',
    description TEXT             NOT NULL,
    weight      INT(11)          NOT NULL DEFAULT '0',
    PRIMARY KEY (cid),
    KEY pid (pid)
)
    ENGINE = MyISAM
    DEFAULT CHARSET = utf8;

CREATE TABLE quiz_questions (
    question_id   INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
    quiz_id       INT(10) UNSIGNED NOT NULL,
    score         INT(10)         DEFAULT '1',
    qnumber       INT(5) UNSIGNED DEFAULT '1',
    question_type VARCHAR(2)      DEFAULT NULL,
    question      TEXT,
    PRIMARY KEY (question_id),
    KEY quiz_id (quiz_id)
)
    ENGINE = MyISAM
    DEFAULT CHARSET = utf8;

CREATE TABLE quiz_answers (
    answer_id   INT(10) NOT NULL AUTO_INCREMENT,
    question_id INT(10) NOT NULL,
    is_correct  TINYINT(1)   DEFAULT '0',
    answer      VARCHAR(255) DEFAULT NULL,
    PRIMARY KEY (answer_id),
    KEY question_id (question_id)
)
    ENGINE = MyISAM
    DEFAULT CHARSET = utf8;

CREATE TABLE quiz_score (
    id     INT(10) UNSIGNED NOT NULL,
    userid INT(11) UNSIGNED NOT NULL,
    quizId INT(10)          NOT NULL,
    score  INT(11)          NOT NULL,
    date   DATETIME         NOT NULL,
    PRIMARY KEY (id, userid)
)
    ENGINE = InnoDB
    DEFAULT CHARSET = utf8;

CREATE TABLE quiz_useranswers (
    questId INT(10)                NOT NULL,
    quizId  INT(10)                NOT NULL,
    userId  INT(11)                NOT NULL,
    userAns ENUM ('1','2','3','4') NOT NULL,
    PRIMARY KEY (questId, quizId, userId)
)
    ENGINE = InnoDB
    DEFAULT CHARSET = utf8;


CREATE TABLE quiz_quizquestion (
    id       INT(10) UNSIGNED       NOT NULL AUTO_INCREMENT,
    qid      INT(10) UNSIGNED       NOT NULL,
    question VARCHAR(200)           NOT NULL,
    qnumber  INT(10) UNSIGNED       NOT NULL,
    score    INT(10) UNSIGNED       NOT NULL,
    ans1     VARCHAR(200) DEFAULT NULL,
    ans2     VARCHAR(200) DEFAULT NULL,
    ans3     VARCHAR(200) DEFAULT NULL,
    ans4     VARCHAR(200) DEFAULT NULL,
    answer   ENUM ('1','2','3','4') NOT NULL,
    PRIMARY KEY (id)
)
    ENGINE = InnoDB
    DEFAULT CHARSET = utf8;
