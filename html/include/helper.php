<?php
#ページネーションを返す関数
function pager($c,$t){
    $current_page = $c;     //現在のページ
    $total_rec = $t;    //総レコード数
    $page_rec   = 16;   //１ページに表示するレコード
    $total_page = ceil($total_rec / $page_rec); //総ページ数
    $show_nav = 3;  //表示するナビゲーションの数  ここポイント
    $path = '?page=';   //パーマリンク

    //全てのページ数が表示するページ数より小さい場合、総ページを表示する数にする
    if ($total_page < $show_nav) {
        $show_nav = $total_page;
    }
    //トータルページ数が2以下か、現在のページが総ページより大きい場合表示しない
    if ($total_page <= 1 || $total_page < $current_page ) return;
    //総ページの半分
    $show_navh = floor($show_nav / 2);
    //現在のページをナビゲーションの中心にする
    $loop_start = $current_page - $show_navh;
    $loop_end = $current_page + $show_navh;
    //現在のページが両端だったら端にくるようにする
    if ($loop_start <= 0) {
        $loop_start  = 1;
        $loop_end = $show_nav;
    }
    if ($loop_end > $total_page) {
        $loop_start  = $total_page - $show_nav +1;
        $loop_end =  $total_page;
    }
    ?>
    <div id="pagenation">
        <ul>
            <?php
            //2ページ移行だったら「一番前へ」を表示
            if ( $current_page > 2) echo '<li class="prev"><a href="'. $path .'1">&laquo;</a></li>';
            //最初のページ以外だったら「前へ」を表示
            if ( $current_page > 1) echo '<li class="prev"><a href="'. $path . ($current_page-1).'">&lsaquo;</a></li>';
            for ($i=$loop_start; $i<=$loop_end; $i++) {
                if ($i > 0 && $total_page >= $i) {
                    if($i == $current_page) echo '<li class="active">';
                    else echo '<li>';
                    echo '<a href="'. $path . $i.'">'.$i.'</a>';
                    echo '</li>';
                }
            }
            //最後のページ以外だったら「次へ」を表示
            if ( $current_page < $total_page) echo '<li class="next"><a href="'. $path . ($current_page+1).'">&rsaquo;</a></li>';
            //最後から２ページ前だったら「一番最後へ」を表示
            if ( $current_page < $total_page - 1) echo '<li class="next"><a href="'. $path . $total_page.'">&raquo;</a></li>';
            ?>
        </ul>
    </div>
	
    <?php
}

