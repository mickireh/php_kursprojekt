<?php
    function createContent($data) {
        $s = '<div class="leftcolumn"><div class="card">
            <h2>'.htmlspecialchars($data['headline']).'</h2><h5>'.htmlspecialchars($data['subheadline']).'</h5><div class="fakeimg" style="height:200px;">Image</div><p>'.htmlspecialchars($data['text']).'</p></div></div>';
        return $s;
    }
?>