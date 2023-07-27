<?php

declare(strict_types=1);

namespace Modules\UI\Services;

use Throwable;
use function Safe\file_get_contents;
use function Safe\preg_replace;


/**
 * Class SvgService.
 */
class SvgService
{
    /**
     * Check if $path provided is SVG.
     */
    public static function isSVG(?string $path): bool
    {
        if (null === $path) {
            return false;
        }
        // if (is_string($path)) {
        $extension = strrchr($path, '.');
        if (false === $extension) {
            return false;
        }

        return 'svg' === substr($extension, 1);
        // }

        // return false;
    }

    /**
     * Get SVG content.
     */
    public static function getSVG(string $filepath, string $class = ''): string
    {
        //  echo $filepath;

        if (! \is_string($filepath) || ! file_exists($filepath)) {
            return '';
        }

        $svg_content = file_get_contents($filepath);

        $dom = new \DOMDocument();

        if (false === $svg_content) {
            return '';
        }
        $dom->loadXML($svg_content);

        // remove unwanted comments
        $xpath = new \DOMXPath($dom);
        $comments = (array) $xpath->query('//comment()');
        foreach ($comments as $comment) {
            $comment->parentNode->removeChild($comment);
        }

        // remove unwanted tags
        $title = $dom->getElementsByTagName('title');
        if ($title['length']) {
            if (null === $dom->documentElement) {
                throw new \Exception('$dom->documentElement==null');
            }
            $dom->documentElement->removeChild($title[0]);
        }
        $desc = $dom->getElementsByTagName('desc');
        if ($desc['length']) {
            if (null === $dom->documentElement) {
                throw new \Exception('$dom->documentElement==null');
            }
            $dom->documentElement->removeChild($desc[0]);
        }
        $defs = $dom->getElementsByTagName('defs');
        if ($defs['length']) {
            // inserisco questo try catch perchè creando l'action ShowAllIconsAction
            // aveva problemi quando arrivava a metronic_one\Resources\views\media\svg\illustrations\features.svg
            /*
            try {
                $dom->documentElement->removeChild($defs[0]);
            } catch (Throwable $e) {
                //dddx([$filepath, $defs['length']]);
            }
            */
            if (null === $dom->documentElement) {
                throw new \Exception('$dom->documentElement==null');
            }

            $dom->documentElement->removeChild($defs[0]);
        }

        // remove unwanted id attribute in g tag
        $g = $dom->getElementsByTagName('g');
        foreach ($g as $el) {
            $el->removeAttribute('id');
        }
        $mask = $dom->getElementsByTagName('mask');
        foreach ($mask as $el) {
            $el->removeAttribute('id');
        }
        $rect = $dom->getElementsByTagName('rect');
        foreach ($rect as $el) {
            $el->removeAttribute('id');
        }
        $path = $dom->getElementsByTagName('path');
        foreach ($path as $el) {
            $el->removeAttribute('id');
        }
        $circle = $dom->getElementsByTagName('circle');
        foreach ($circle as $el) {
            $el->removeAttribute('id');
        }
        $use = $dom->getElementsByTagName('use');
        foreach ($use as $el) {
            $el->removeAttribute('id');
        }
        $polygon = $dom->getElementsByTagName('polygon');
        foreach ($polygon as $el) {
            $el->removeAttribute('id');
        }
        $ellipse = $dom->getElementsByTagName('ellipse');
        foreach ($ellipse as $el) {
            $el->removeAttribute('id');
        }

        $string = $dom->saveXML($dom->documentElement);

        if (! $string) {
            $string = '';
        }

        // remove empty lines
        $string = preg_replace("/(^[\r\n]*|[\r\n]+)[\s\t]*[\r\n]+/", "\n", $string);

        $cls = ['svg-icon'];
        if (! empty($class)) {
            $cls = array_merge($cls, explode(' ', $class));
        }

        return '<span class="'.implode(' ', $cls).'"><!--begin::Svg Icon | path:'.$filepath.'-->'.$string.'<!--end::Svg Icon--></span>';
    }
}
