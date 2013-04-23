<?php
 
function wp_syntax_line_numbers($code, $start)
{
    $line_count = count(explode("\n", $code));
    $output = '<pre>';
    for ($i = 0; $i < $line_count; $i++)
    {
        $output .= ($start + $i) . "\n";
    }
    $output .= '</pre>';
    return $output;
}

function highlight_src($source, $lang, $start_line)
{
  /*
        $geshi = new GeSHi($source, $lang);
 
        return $geshi->parse_code();
  */
    $language = strtolower($lang);
    $line = empty($start_line) ? -1 : intval($start_line);
    // $escaped = trim($match[3]);
    $code = $source;
    // $code = wp_syntax_code_trim($source);
    //    if ($escaped == "true") $code = htmlspecialchars_decode($code);

    $geshi = new GeSHi($code, $language);
    $geshi->enable_keyword_links(false);
    do_action_ref_array('wp_syntax_init_geshi', array(&$geshi));

    $output = "\n<div class=\"wp_syntax\">";

    if ($line >= 0)
    {
        $output .= "<table><tr><td class=\"line_numbers\">";
        $output .= wp_syntax_line_numbers($code, $line);
        $output .= "</td><td class=\"code\">";
        $output .= $geshi->parse_code();
        $output .= "</td></tr></table>";
    }
    else
    {
        $output .= "<div class=\"code\">";
        $output .= $geshi->parse_code();
        $output .= "</div>";
    }
    return

    $output .= "</div>\n";

    return $output;
}
 
?>
