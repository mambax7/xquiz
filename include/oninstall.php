<?php

/**
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
 * @copyright         XOOPS Project (https://xoops.org)
 * @license           GNU GPL 2 (https://www.gnu.org/licenses/old-licenses/gpl-2.0.html)
 * @package           quiz
 * @author            Mojtaba Jamali(jamali.mojtaba@gmail.com)
 * @version           $Id: $
 */
function xoops_module_install_quiz()
{
    $dir = XOOPS_ROOT_PATH . '/uploads/quiz';

    if (!is_dir($dir)) {
        if (!mkdir($dir, 0777) && !is_dir($dir)) {
            throw new \RuntimeException(sprintf('Directory "%s" was not created', $dir));
        }

        chmod($dir, 0777);
    }
    $currentemptyfile     = XOOPS_ROOT_PATH . '/uploads/index.html';
    $destinationemptyfile = XOOPS_ROOT_PATH . '/uploads/quiz/index.html';
    copy($currentemptyfile, $destinationemptyfile);

    $dir = XOOPS_ROOT_PATH . '/uploads/quiz/image';

    if (!is_dir($dir)) {
        if (!mkdir($dir, 0777) && !is_dir($dir)) {
            throw new \RuntimeException(sprintf('Directory "%s" was not created', $dir));
        }

        chmod($dir, 0777);
    }

    $currentemptyfile     = XOOPS_ROOT_PATH . '/uploads/index.html';
    $destinationemptyfile = XOOPS_ROOT_PATH . '/uploads/quiz/image/index.html';
    copy($currentemptyfile, $destinationemptyfile);

    $dir = XOOPS_ROOT_PATH . '/uploads/quiz/category';

    if (!is_dir($dir)) {
        if (!mkdir($dir, 0777) && !is_dir($dir)) {
            throw new \RuntimeException(sprintf('Directory "%s" was not created', $dir));
        }

        chmod($dir, 0777);
    }

    $currentemptyfile     = XOOPS_ROOT_PATH . '/uploads/index.html';
    $destinationemptyfile = XOOPS_ROOT_PATH . '/uploads/quiz/category/index.html';
    copy($currentemptyfile, $destinationemptyfile);
    $currentblankimage     = XOOPS_ROOT_PATH . '/modules/quiz/assets/images/blank.png';
    $destinationblankimage = XOOPS_ROOT_PATH . '/uploads/quiz/category/blank.png';
    copy($currentblankimage, $destinationblankimage);
}
