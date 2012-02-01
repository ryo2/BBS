		  function chkHissu(frm){
        /* 必須入力のname属性 */
        var hissu=Array("title","comment");
        /* アラート表示用 */
        var hissu_nm = Array("トピック名","書き込み内容");
        /* 必須入力の数 */
        var len=hissu.length;
        for(i=0; i<len; i++){
            var obj=frm.elements[hissu[i]];
            /* テキストボックス or テキストエリアが入力されているか調べる */
            if(obj.type=="text" || obj.type=="textarea"){
                if(obj.value==""){
                    /* 入力されていなかったらアラート表示 */
                    alert(hissu_nm[i]+"は必ず入力が必要です");
                    /* 未入力のエレメントにフォーカスを当てる */
                    frm.elements[hissu[i]].focus();
                    return false;
                }
            }else{
                /* radioボタンがチェックされているか調べる */
                for(var j=0, chk=0; j<obj.length; j++){
                    /* チェックされていたらchkフラグをプラス */
                    if(obj[j].checked) chk++;
                }
                if(chk==0){
                    /* 1つもチェックされていない場合はfalseを返してフォーム送信しない */
                    alert(hissu_nm[i]+"は必須入力項目です");
                    return false;
                }
            }
        }
        /* 必須入力項目が全て入力されている場合はtrueを返してフォーム送信 */
        return true;
    }    


//テスト用
    function test(){
  alert("おはよう");
}


