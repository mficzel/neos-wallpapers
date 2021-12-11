<?php
declare(strict_types=1);

namespace Neos\Wallpapers\Controller;

use Neos\Flow\Annotations as Flow;
use Neos\Flow\Mvc\Controller\ActionController;
use Neos\Flow\ResourceManagement\ResourceManager;
use Neos\Utility\Files;
use Psr\Http\Message\UriFactoryInterface;

class WallpaperController extends ActionController
{
    /**
     * @var array
     * @Flow\InjectConfiguration(path="sources")
     */
    protected $sources;

    /**
     * @var array
     * @Flow\InjectConfiguration(path="fallbackSource")
     */
    protected $fallbackSource;

    /**
     * @var ResourceManager
     * @Flow\Inject
     */
    protected $resourceManager;

    /**
     * @var UriFactoryInterface
     * @Flow\Inject
     */
    protected $uriFactory;

    /**
     * Find all images in the configured source folders, select a random one and send a redirect
     */
    public function randomWallpaperAction()
    {
        $possibleWallpaperResourcePathes = [];
        foreach($this->sources as $key =>  $source) {
            if (is_string($source) && is_dir($source)) {
                $files = Files::readDirectoryRecursively($source, 'jpg');
                foreach ($files as $file) {
                    $possibleWallpaperResourcePathes[] = $file;
                }
            }
        }

        $numberOfImages = count($possibleWallpaperResourcePathes);
        if ($numberOfImages > 0) {
            $randomResourceIndex = mt_rand(0, count($possibleWallpaperResourcePathes) - 1);
            $uri = $this->resourceManager->getPublicPackageResourceUriByPath($possibleWallpaperResourcePathes[$randomResourceIndex]);
            $this->response->setRedirectUri($this->uriFactory->createUri($uri));
        } else {
            $uri = $this->resourceManager->getPublicPackageResourceUriByPath($this->fallbackSource);
            $this->response->setRedirectUri($this->uriFactory->createUri($uri));
        }
        return '';
    }
}
