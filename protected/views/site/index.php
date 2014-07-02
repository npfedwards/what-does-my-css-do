<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>

<form action="/" method="post">
    <textarea name="css" rows="20" cols="80"></textarea>
    <input type="submit">
</form>

<?php if( $css != null ): ?>
    <?php foreach( $css['main'] as $selector => $rules ): ?>
        <h3><?=$selector; ?></h3>
        <pre><code><?php foreach( $rules as $rule => $value ){
            echo $rule . ' : ' . $value . ";\n";
        }?></code></pre>
        <?php
        $split = explode(',', $selector);
        foreach( $split as $selectors){
            $selectors = explode(' ', $selectors);
            foreach( $selectors as $sel ){
                $sel = str_replace(array(':hover', ':focus', ':visited'), '', $sel);
                if( $sel == null || $sel == ' '){
                    continue;
                }
                if( substr($sel, 0, 1) == '.' ){
                    echo "<div class='" . str_replace('.', ' ', $sel) . "'>";
                }elseif( substr($sel, 0, 1) == '#' ){
                    echo "<div id='" . substr($sel, 1) . "'>";
                }else{
                    if( strpos($sel, '.') > -1 ){
                        $sel = explode('.', $sel);
                        echo "<" . $sel[0] . " class='" . str_replace('.', ' ', $sel[1]) . "'>";
                    }elseif( strpos($sel, '#') > -1 ){
                        $sel = explode('#', $sel);
                        echo "<" . $sel[0] . " id='" . substr($sel[1], 1) . "'>";
                    }else{
                        echo "<$sel>";
                    }
                }
            }
            echo "Text";
            rsort($selectors);
            foreach( $selectors as $sel ){
                $sel = str_replace(array(':hover', ':focus', ':visited'), '', $sel);
                if( $sel == null || $sel == ' '){
                    continue;
                }
                if( substr($sel, 0, 1) == '.' ){
                    echo "</div>";
                }elseif( substr($sel, 0, 1) == '#' ){
                    echo "</div>";
                }else{
                    if( strpos($sel, '.') > -1 ){
                        $sel = explode('.', $sel);
                        echo "</" . $sel[0] . ">";
                    }elseif( strpos($sel, '#') > -1 ){
                        $sel = explode('#', $sel);
                        echo "</" . $sel[0] . ">";
                    }else{
                        echo "</$sel>";
                    }
                }
            }
        }
        ?>
        <hr>
    <?php endforeach; ?>
<?php endif;?>