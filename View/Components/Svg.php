<?php

declare(strict_types=1);

namespace Modules\UI\View\Components;

use Illuminate\Support\Facades\File;
use Illuminate\View\Component;
use Modules\Xot\Services\FileService;
use Symfony\Component\DomCrawler\Crawler;

/**
 * Class Test.
 * https://github.com/blade-ui-kit/blade-icons/blob/1.x/src/Components/Svg.php.
 *
 * esempio di utilizzo
 * <x-svg icon="github" class="classi_qualsiasi" />
 * <x-svg icon="twitter" class="classi_qualsiasi" />
 */
class Svg extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public string $icon;

    public array $attrs;

    public function __construct(string $icon)
    {
        $this->icon = $icon;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): \Illuminate\Contracts\Support\Renderable
    {
        // $content=File::get()
        $svg_path = FileService::fixPath(module_path('ui', 'Resources/svg/'.$this->icon.'.svg'));
        $svg_content = File::get($svg_path);
        // $xml = simplexml_load_string($svg_content);

        // $this->attrs = get_class_methods($xml);
        // $this->attrs = $xml->children()->path;

        // $crawler = new Crawler($svg_content);

        // $this->attrs = get_class_methods($crawler);
        // $this->attrs = get_class_methods($crawler->filter('svg')->first());

        // $this->attrs = $crawler->filter('svg')->extract(['_text', 'fill', 'viewBox', 'text']);
        // $this->attrs = $crawler->filter('svg')->children();
        // $this->attrs = $crawler->filterXPath('//svg');
        // $this->attrs = $crawler->filter('svg')->first()->children();

        // <(.+?)[\s]*\/?[\s]*>
        // $pattern = '/<svg([^>]*)>(\s.*)/im';
        $pattern = '/<(.+?)[\s]*\/?[\s]*>\s*(<.+?[\s]*\/?[\s]*>)/im';
        preg_match($pattern, $svg_content, $m);
        /*
        $m1='viewBox="0 0 24 24" fill="currentColor"';
        $m2='<path d="M23.954 4.569c-.885.389-1.83.654-2.825.775 1.014-.611 1.794-1.574 2.163-2.723-.951.555...'
        */
        $xml = simplexml_load_string($svg_content);
        if (null == $xml) {
            throw new \Exception('simplexml_load_string ['.$svg_path.']['.__LINE__.']['.class_basename(__FILE__).']');
        }
        // Strict comparison using === between false and SimpleXMLElement|null will always evaluate to false.
        // if (false == $xml || false === $xml->attributes()) {
        if (null == $xml || null == $xml->attributes()) {
            throw new \Exception('simplexml_load_string ['.$svg_path.']['.__LINE__.']['.class_basename(__FILE__).']');
        }
        $str = @json_encode($xml->attributes());
        if (false === $str) {
            throw new \Exception('simplexml_load_string ['.$svg_path.']['.__LINE__.']['.class_basename(__FILE__).']');
        }
        $tmp = @json_decode($str, true);
        if (\is_array($tmp)) {
            $this->attrs = $tmp['@attributes'];
        }
        if (\count($m) < 2) {
            throw new \Exception('svg ['.$svg_path.'] is strange ['.__LINE__.']['.__FILE__.']');
        }

        /**
         * @phpstan-var view-string
         */
        $view = 'ui::components.svg';
        $view_params = [
            'view' => $view,
            'svg_content' => $svg_content,
            'attrs' => $this->attrs,
            'svg_html' => $m[2],
        ];

        return view()->make($view, $view_params);
    }
}

/*
$pattern = '/<svg[^>]*>\s*(<defs.*?>.*?<\ /defs>)\s*<\ /svg>/';
        preg_match($pattern, $svg_content, $m);
        */
/*
$xml = simplexml_load_string($svg_content);
$tmp = @json_decode(@json_encode($xml->attributes()), true);
$tmp = $tmp['@attributes'];
$this->attrs = $xml->text();
*/
// $this->attrs = $m;
