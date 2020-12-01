
<hr width='80%'>
	<div id="pageTitle"> 
		<label id="pageTitle-lbl"><?php echo $_GET['page']; ?></label>
	</div> 
<hr width='80%'>

<script type="text/javascript" src="./js/tapCtrl.js"></script>
<script type="text/javascript">

    // 規程のイベント処理を実行しないにしているため、リンクタグなどがある場合に注意
    function bind_Event_noticeTabel() {
        
        var touched = false;
        var touch_time = 0;
        var timer='';
        
        $("#notice-table tr").bind('touchstart',function(e) {
            clickStart(e);
        });
        $("#notice-table tr").bind('touchend',function(e) {
            clickEnd(e);
        });
        $("#notice-table tr").bind('touchmove',function(e) {
            clickMove(e);
        });
        $("#notice-table tr").bind('gesturestart',function(e) {
            clickMove(e);
        });
        $("#notice-table tr").bind('gestureend',function(e) {
            clickMove(e);
        });


        $("#notice-table tr").bind('mousedown',function(e) {
            clickStart(e);
        });
        $("#notice-table tr").bind('mouseup',function(e) {
            clickEnd(e);
        });
        $("#notice-table tr").bind('mousemove',function(e) {
            clickMove(e);
        });

        function clickStart(e){
            
            touched = true;
            touch_time = 0;
            timer = setInterval(function(){

                touch_time += 100;
                if(touch_time == 2000){
                    clickEnd(e);
                }
                console.log('setInterval：' + touch_time);
            }, 100);

            // e.preventDefault();
        }
        function clickEnd(e){
            if (touched) {
                if (touch_time < 500 ) {
                    // 短いタップでの処理
                    var newTabFlg = "";
                    /*
                    if(e.currentTarget.getAttribute('target') == '_blank'){
                        newTabFlg = true;
                    }else{
                        newTabFlg = false;
                    }
                    */
                    newTabFlg = true;
                    Sub_SingleTap(e.currentTarget.getAttribute('href1'), newTabFlg);

                }else if(touch_time < 2000 ){
                    // ミドルタップ処理
                    Sub_middleTap(e.currentTarget.getAttribute('href2'), true);
                
                }else{
                    // 長押し お気に入り削除処理無し
                    /* ユーザ登録機能を制限するため、お気に入り登録機能も制限　2020/10/31
                    Sub_longTap("<?php echo $_SESSION['ID']; ?>", 
                                 e.currentTarget.getAttribute('shopId'), 
                                 '<?php echo ゲストユーザ['ID']; ?>');
                    */
                }
            }
            touched = false;
            clearInterval(timer);
            touch_time = 0;
            e.preventDefault();

        }
        function clickMove(e){
            touched = false;
            clearInterval(timer);
            touch_time = 0;
        }
    }

</script>

<?php
    require comフォルダ . "com_通知検索条件.php"
?>

<div class="content-notice">
    <table id="notice-table">
        <tr id="row_title">
            <th class="clm-noticeKbn"></th>
            <th class="clm-shopName">店名</th>
            <th class="clm-msg">メッセージ</th>
            <th class="clm-startTime">通知開始時刻</th>
        </tr>
    </table>
</div>

<script>
    Fnc_Search();
    bind_Event_noticeTabel();
</script>
