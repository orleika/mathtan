<!-- <?php

session_start();

require_once dirname(__FILE__) . '/vendor/autoload.php';
require_once dirname(__FILE__) . '/lib/CsrfProtector.php';
?> -->
<!DOCTYPE html>
<html>

<head>
  <title>Check Your Math.tan</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="IE=Edge">
  <link rel="stylesheet" href="//fonts.googleapis.com/icon?family=Material+Icons">
  <link rel="stylesheet" href="//code.getmdl.io/1.3.0/material.teal-blue.min.css">
  <style>
    .is-hide {
      display: none;
    }

    @keyframes fadeIn {
      0% {opacity: 0}
      100% {opacity: 1}
    }

    @-webkit-keyframes fadeIn {
      0% {opacity: 0}
      100% {opacity: 1}
    }
  </style>
</head>

<body>
  <div class="mdl-layout__container">
    <div class="mdl-layout mdl-js-layout">
      <main class="mdl-layout__content">
        <div class="mdl-grid">
          <div class="mdl-cell mdl-cell--8-col mdl-cell--2-offset-desktop">
            <h1 class="mdl-typography--font-light mdl-typography--display-1-color-contrast mdl-typography--text-center">
              Check Your Math.tan
            </h1>
            <hr>
            <form name="profileForm" class="mdl-typography--font-light mdl-typography--text-center">
              <p class="mdl-typography--body-2 mdl-typography--text-center">DO NOT spoof your user-agent!</p>
              <input type="hidden" name="_token" value="<?=CsrfProtector::generate()?>">
              <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                <textarea class="mdl-textfield__input" type="text" rows="3" name="note" id="note"></textarea>
                <label class="mdl-textfield__label" for="note">Note...</label>
              </div>
              <div>
                <input type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored" value="Run">
              </div>
            </form>
            <div id="result" class="is-hide" style="overflow: scroll;">
              <table class="mdl-data-table mdl-js-data-table mdl-data-table--selectable mdl-shadow--2dp" style="margin: 20px auto;">
                <tbody>
                  <tr>
                    <td class="mdl-data-table__cell--non-numeric">User Agent</td>
                    <td id="userAgent" class="mdl-data-table__cell--non-numeric">{{userAgent}}</td>
                  </tr>
                  <tr>
                    <td class="mdl-data-table__cell--non-numeric">Math.tan</td>
                    <td id="mathTan" class="mdl-data-table__cell--non-numeric">{{mathTan}}</td>
                  </tr>
                  <tr>
                    <td class="mdl-data-table__cell--non-numeric">OS</td>
                    <td id="os" class="mdl-data-table__cell--non-numeric">{{os}}</td>
                  </tr>
                  <tr>
                    <td class="mdl-data-table__cell--non-numeric">OS (estimate)</td>
                    <td id="estimateOS" class="mdl-data-table__cell--non-numeric">{{estimate os}}</td>
                  </tr>
                  <tr>
                    <td class="mdl-data-table__cell--non-numeric">Browser</td>
                    <td id="browser" class="mdl-data-table__cell--non-numeric">{{browser}}</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </main>
    </div>
  </div>
  <script src="bower_components/ua-parser-js/dist/ua-parser.min.js"></script>
  <script defer src="//code.getmdl.io/1.3.0/material.min.js"></script>
  <script>
  (function () {
    var mathTan = Math.tan(-1e300)
    var form = document.forms.namedItem('profileForm')
    form.addEventListener('submit', function(ev) {
      var fd = new FormData(form)
      fd.append('mathTan', mathTan)
      fd.append('userAgent', window.navigator.userAgent)

      var xhr = new XMLHttpRequest()
      xhr.open('POST', 'save.php', true)
      xhr.onload = function(xhrEv) {
        if (xhr.status === 200) {
          var parser = new UAParser()
          var result = parser.getResult()
          document.getElementById('userAgent').textContent = window.navigator.userAgent
          document.getElementById('mathTan').textContent = mathTan
          document.getElementById('browser').textContent = JSON.stringify(result.browser)
          document.getElementById('os').textContent = JSON.stringify(result.os)
          document.getElementById('estimateOS').textContent = detectOS(mathTan)
          document.forms.namedItem('profileForm').style.display = 'none'
          document.getElementById('result').style.animation = 'fadeIn 2s ease 0s 1 normal'
          document.getElementById('result').style['-webkit-animation'] = 'fadeIn 2s ease 0s 1 normal'
          document.getElementById('result').style.display = 'block'
        } else {
          console.error('error has occurred.')
        }
      }
      xhr.send(fd)

      ev.preventDefault()
    })

    function detectOS(mathTan) {
      if (mathTan === -1.4214488238747245) {
        return 'Linux 64'
      } else if (mathTan === 0.8831488831618285) {
        return 'Linux 32'
      } else if (mathTan === -4.987183803371025) {
        return 'Windows'
      } else {
        return 'Mac OS X'
      }
    }
  }())
  </script>
</body>

</html>
