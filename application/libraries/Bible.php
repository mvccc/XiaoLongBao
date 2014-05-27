<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

Class Bible {

  /** @const */
  private static $catalog = array (
      "Genesis" => "創",
      "Exodus" => "出",
      "Leviticus" => "利",
      "Numbers" => "民",
      "Deuteronomy" => "申",
      "Joshua" => "書",
      "Judges" => "士",
      "Ruth" => "得",
      "1 Samuel" => "撒上",
      "2 Samuel" => "撒下",
      "1 Kings" => "王上",
      "2 Kings" => "王下",
      "1 Chronicles" => "代上",
      "2 Chronicles" => "代下",
      "Ezra" => "拉",
      "Nehemiah" => "尼",
      "Esther" => "斯",
      "Job" => "伯",
      "Psalms" => "詩",
      "Proverbs" => "箴",
      "Ecclesiastes" => "傳",
      "Song of Songs" => "歌",
      "Isaiah" => "賽",
      "Jeremiah" => "耶",
      "Lamentations" => "哀",
      "Ezekiel" => "結",
      "Daniel" => "但",
      "Hosea" => "何",
      "Joel" => "珥",
      "Amos" => "摩",
      "Obadiah" => "俄",
      "Jonah" => "拿",
      "Micah" => "彌",
      "Nahum" => "鴻",
      "Habakkuk" => "哈",
      "Zephaniah" => "番",
      "Haggai" => "該",
      "Zechariah" => "亞",
      "Malachi" => "瑪",

      "Matthew" => "太",
      "Mark" => "可",
      "Luke" => "路",
      "John" => "約",
      "Acts" => "徒",
      "Romans" => "羅",
      "1 Corinthians" => "林前",
      "2 Corinthians" => "林後",
      "Galatians" => "加",
      "Ephesians" => "弗",
      "Philippians" => "腓",
      "Colossians" => "西",
      "1 Thessalonians" => "帖前",
      "2 Thessalonians" => "帖後",
      "1 Timothy" => "提前",
      "2 Timothy" => "提後",
      "Titus" => "多",
      "Philemon" => "門",
      "Hebrews" => "來",
      "James" => "雅",
      "1 Peter" => "彼前",
      "2 Peter" => "彼後",
      "1 John" => "約壹",
      "2 John" => "約貳",
      "3 John" => "約參",
      "Jude" => "猶",
      "Revelation" => "啟"
  );

  const REQUEST_URL = 'http://api.preachingcentral.com/bible.php?';
  const VERSION = 'union-traditional';
  
  static function getChTitle($engTitle)
  {
    return self::$catalog[$engTitle];
  }

  /**
   * Convert the English ranges string to Chinese abbreviation
   * e.g. "John 1:1-3" => "約 1:1-3"
   */
  static function convertEngRangesToCh($ranges)
  {
    $string = $ranges;
    $token = strtok($string, ",");
    while ($token != false)
    {
      $pos = strpos($token, ":");
      if ($pos !== false)
      {
        // remove leading and tailing spaces of book and chapter, e.g." Acts 3 "
        $token = trim(substr($token, 0, $pos));
        $pos = strrpos($token, " ");
        if ($pos > 1) // avoid to pick space in book name
        {
          $token = substr($token, 0, $pos);
        }

        // now we have book name
        // only replace the first matching string to avoid "1 John" etc. be considered as "John"
        $pos = strpos($ranges, $token);
        if ($pos !== false) {
          $ranges = substr_replace($ranges, self::getChTitle($token), $pos, strlen($token));
        }
      }

      $token = strtok(",");
    }

    return $ranges;
  }
  
  /**
   * Given ranges, e.g. "John 3:1-3, 5", returns a parsed SimpleXMLElement object $xml.
   * 
   * For each $xml->range
   * $xml->range->result is the title "John 3:1-3" for this range
   * $xml->range->item->text is the verses
   * You could also get book name, chapter, etc from $xml->range->item
   */
  public function getVerses($ranges)
  {
    // send a REST request and get XML response
    $url = self::REQUEST_URL . 'passage=' . urlencode($ranges) . '&version=' . self::VERSION;
    $content = @file_get_contents($url);
    
    // Parse the XML into a SimpleXML object
    $xml = new SimpleXMLElement($content);
    return $xml;
  }
  
  
}