/**
 * ユーティリティ関数
 */
var util = {
  /**
   * AjaxでJSONを取得する
   * @param {string} url  実行URL
   * @param {Array} data パラメータ用のデータ
   * @param {function} callbackFunc データ取得時のコールバック関数
   * @param {function} beforesendFunc 処理開始前のコールバック関数
   * @param {function} completeFunc 処理終了時のコールバック関数
   */
  getJson: function(url, data, callbackFunc, beforesendFunc, completeFunc) {
    $.ajax({
      url: url,
      type: 'GET',
      cache: false,
      dataType: 'json',
      data: data,
      timeout: 30000,
      mimeType: 'application/json;charset=utf-8',
      // 送信前
      beforeSend: beforesendFunc,
      // 応答後
      complete: completeFunc,

      // 通信成功時の処理
      success: function(result, textStatus, xhr) {
        var station = result.contents;
        if (result.resultCode != 0) {
           console.log(result.errorMsg);
        }
        callbackFunc(result.resultCode, result.contents);
      },

      // 通信失敗時の処理
      error: function(xhr, textStatus, error) {
        if (!error) {
          error = 'ConnectError';
        }
        console.log(error);
        callbackFunc(9999, {});
      }
    });
  },

  /**
   * クエリーパラメータを配列で取得
   * @return {Array} クエリパラメータの配列
   */
  getQueryParam: function() {
    var qsParm = new Array();

    var query = window.location.search.substring(1);
    var parms = query.split('&');
    for (var i = 0; i < parms.length; i++) {
      var pos = parms[i].indexOf('=');
      if (pos > 0) {
        var key = parms[i].substring(0, pos);
        var val = parms[i].substring(pos + 1);
        qsParm[key] = val;
      }
    }
    return qsParm;
  },
  getEscapedId: function(id) {
    id = id.replace(/\:/g, '\\:');
    id = id.replace(/\./g, '\\.');
    return id;
  },

  /**
   * Jquery-mobile用のダイアログメッセージ
   */
  showPopupDialog: function(message) {
    $('#msgPopup').find('[data-role="main"]').html(message);
    $(':mobile-pagecontainer').pagecontainer(
      'change',
      '#msgPopup',
      {
        transition: 'pop',
        role: 'dialog'
      }
    );
  },

  /**
   * Jquery-mobile用のポップアップメッセージ
   */
  showPopup: function(popId, message, target) {
    // $(popId).html(message).popup('open', { positionTo: target });
    // 中央の方が誤りタップが少ないと思われる。
    var pop = $(popId);
    pop.find('span').html(message);
    pop.popup('open', { positionTo: 'origin', transition: 'pop'});
  }
};
