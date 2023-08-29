<?php


namespace App\WidgetsBuilder\Widgets;

use App\Facades\GlobalLanguage;
use App\Helpers\LanguageHelper;
use App\Models\Language;
use App\PageBuilder\Fields\Image;
use App\PageBuilder\Fields\Number;
use App\PageBuilder\Fields\Select;
use App\PageBuilder\Fields\Summernote;
use App\PageBuilder\Fields\Text;
use App\PageBuilder\Traits\LanguageFallbackForPageBuilder;
use App\Models\Tag;
use App\WidgetsBuilder\WidgetBase;
use Illuminate\Support\Str;

class ArchieveSearch extends WidgetBase
{
    use LanguageFallbackForPageBuilder;

    public function admin_render()
    {
        $output = $this->admin_form_before();
        $output .= $this->admin_form_start();
        $output .= $this->default_fields();
        $widget_saved_values = $this->get_settings();

        //render language tab
        $output .= $this->admin_language_tab();
        $output .= $this->admin_language_tab_start();


        $all_languages = LanguageHelper::all_languages();
        foreach ($all_languages as $key => $lang) {
            $output .= $this->admin_language_tab_content_start([
                'class' => $key == 0 ? 'tab-pane fade show active' : 'tab-pane fade',
                'id' => "nav-home-" . $lang->slug
            ]);
            $output .= Text::get([
                'name' => 'title_'.$lang->slug,
                'label' => __('Select date for search'),
                'value' => $widget_saved_values['title_' . $lang->slug] ?? null,
            ]);
            $output .= $this->admin_language_tab_content_end();
        }
        $output .= $this->admin_language_tab_end(); //have to end language tab

        $output .= $this->admin_form_submit_button();
        $output .= $this->admin_form_end();
        $output .= $this->admin_form_after();

        return $output;
    }

    public function frontend_render()
    {
        $settings = $this->get_settings();
        $user_selected_language = GlobalLanguage::user_lang_slug();
        $widget_title = purify_html($settings['title_' . $user_selected_language] ?? '');
        $route = route('frontend.blog.archive.search');
        $search_btn_text = __('Search');

return <<<HTML
    <div class="widget">
        <div class="tag style-02">
            <h4 class="widget-title style-02">{$widget_title}</h4>
            <form action="{$route}" method="get">
                <input type="text" class="form-control" name="archive_search" id="frontend_archive_search" placeholder="Select Date">
                <div class="form-group btn-wrapper">
                    <button type="submit" class="submit-btn btn-default mt-3">{$search_btn_text}</button>
                </div>
            </form>
        </div>
    </div>

HTML;
 }

    public function widget_title()
    {
        return __('Archive Search ');
    }
}