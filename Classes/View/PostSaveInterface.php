<?php

declare(strict_types=1);

namespace Localizationteam\L10nmgr\View;

/**
 * PostSaveInterface
 *
 * @author Peter Russ<peter.russ@4many.net>
 * @date 20150909-2127
 */
interface PostSaveInterface
{
    public function postExportAction(array $params);
}
