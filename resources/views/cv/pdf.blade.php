<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>面談シート</title>
  <style>
    /* Reset minimal */
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
    html, body { height: 100%; background: #fff; color: #000; }
    body {
      font-family: "MS Gothic", "Yu Gothic", "Hiragino Kaku Gothic ProN", "Segoe UI", Arial, sans-serif;
      font-size: 13px;
      line-height: 1.4;
      padding: 16px;
      color: #222;
    }

    /* Container — use table layout for predictable PDF rendering */
    .root-table {
      width: 100%;
      border-collapse: collapse;
      table-layout: fixed;
    }

    .left-col { width: 64%; vertical-align: top; padding-right: 12px; }
    .right-col { width: 36%; vertical-align: top; padding-left: 12px; }

    /* Generic table styles used through document */
    .section-table {
      width: 100%;
      border-collapse: collapse;
      margin-bottom: 12px;
    }
    .section-table th,
    .section-table td {
      border: 1px solid #333;
      padding: 8px;
      vertical-align: top;
      text-align: left;
      font-size: 13px;
    }
    .section-table th {
      background: #e3f2fd;
      font-weight: 700;
      text-align: center;
    }

    /* Specific small helpers */
    .name-cell { width: 120px; font-weight:700; background:#e3f2fd; text-align:left; padding-left:10px; }
    .large-name { text-align:center; font-size:18px; font-weight:700; padding:18px 8px; }
    .input-field { background: #fff; min-height: 28px; }
    .section-header { background:#e3f2fd; font-weight:700; text-align:center; }
    .year-col { width: 18%; text-align:center; }
    .month-col { width: 18%; text-align:center; }
    .content-col { width: 64%; text-align:left; padding-left:12px; }

    /* Photo box */
    .photo-box {
      width: 140px;
      height: 180px;
      border: 1px dashed #666;
      text-align:center;
      font-size:12px;
      padding:8px;
      margin-bottom:12px;
    }
    .photo-box img { max-width: 100%; height: auto; display:block; margin: 0 auto; }

    /* Comments area */
    .comment-table td { height: 140px; }

    /* Blue header bars */
    .blue-row th, .blue-header { background: #e3f2fd; font-weight:700; text-align:center; }

    /* Notes box */
    .notes {
      margin-top: 12px;
      padding: 10px;
      background: #fff9c4;
      border-left: 4px solid #fbc02d;
      font-size: 12px;
      line-height: 1.5;
    }

    /* Make sure long text wraps */
    td, th { word-wrap: break-word; word-break: break-word; }

    /* Print tweaks */
    @media print {
      body { padding: 8px; }
      .photo-box { border-style: dashed; }
      .root-table { page-break-inside: avoid; }
    }
  </style>
</head>
<body>
  <!-- Root layout: two columns (left = main details, right = supplements like photo, license, comments) -->
  <table class="root-table">
    <tr>
      <td class="left-col">

        <!-- Header -->
        <table class="section-table">
          <tr>
            <th colspan="6" style="text-align:left; font-size:18px; padding:12px;">面談シート</th>
          </tr>
          <tr>
            <td colspan="6" style="text-align:center; font-size:13px; padding:8px;">年　　月　　日現在</td>
          </tr>
        </table>

        <!-- Personal info -->
        <table class="section-table">
          <tr>
            <td class="name-cell">ふりがな</td>
            <td class="input-field" colspan="5"></td>
          </tr>

          <tr>
            <td class="name-cell">氏　名</td>
            <td colspan="5" class="large-name">Aldi abduloh</td>
          </tr>

          <tr>
            <td class="name-cell">国籍</td>
            <td>インドネシア</td>

            <td style="width:12%; font-weight:700; text-align:center;">生年月日</td>
            <td style="width:20%;">2001年06月06日</td>

            <td style="width:8%; font-weight:700; text-align:center;">年齢</td>
            <td style="width:12%;">○歳</td>
          </tr>

          <tr>
            <td class="name-cell">現住所</td>
            <td colspan="3">〒　○○県○○市（住所を記載）</td>

            <td style="font-weight:700; text-align:center;">在留資格</td>
            <td>―</td>
          </tr>

          <tr>
            <td class="name-cell">血液型</td>
            <td>○型</td>

            <td style="font-weight:700; text-align:center;">服サイズ</td>
            <td>S / M / L / XL</td>

            <td style="font-weight:700; text-align:center;">結婚</td>
            <td>既婚・未婚</td>
          </tr>

          <tr>
            <td class="name-cell">身長</td>
            <td>○cm</td>

            <td style="font-weight:700; text-align:center;">体重</td>
            <td>○kg</td>

            <td style="font-weight:700; text-align:center;">靴サイズ</td>
            <td>○cm</td>
          </tr>
        </table>

        <!-- Education History -->
        <table class="section-table">
          <thead>
            <tr>
              <th class="section-header" colspan="2">年・月</th>
              <th class="section-header" colspan="3">学　歴</th>
              <th class="section-header" colspan="2">学部・学科</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td colspan="2">○○○○年06月</td>
              <td colspan="3">○○小学校　卒業</td>
              <td colspan="2" class="input-field"></td>
            </tr>
            <tr>
              <td colspan="2">○○○○年06月</td>
              <td colspan="3">○○中学校　卒業</td>
              <td colspan="2" class="input-field"></td>
            </tr>
            <tr>
              <td colspan="2">○○○○年06月</td>
              <td colspan="3">○○高等学校　卒業</td>
              <td colspan="2" class="input-field"></td>
            </tr>
            <tr>
              <td colspan="2" class="input-field"></td>
              <td colspan="3" class="input-field"></td>
              <td colspan="2" class="input-field"></td>
            </tr>
          </tbody>
        </table>

        <!-- Work History -->
        <table class="section-table">
          <thead>
            <tr>
              <th class="section-header" colspan="2">年・月</th>
              <th class="section-header" colspan="3">職　歴</th>
              <th class="section-header" colspan="2">職種</th>
            </tr>
          </thead>
          <tbody>
            <!-- repeat rows as needed -->
            <tr>
              <td colspan="2">○○年○○月 ～ ○○年○○月</td>
              <td colspan="3">株式会社○○○○　退職</td>
              <td colspan="2" class="input-field"></td>
            </tr>

            <!-- empty rows for input -->
            <tr>
              <td colspan="2" class="input-field"></td>
              <td colspan="3" class="input-field"></td>
              <td colspan="2" class="input-field"></td>
            </tr>

            <tr>
              <td colspan="2" class="input-field"></td>
              <td colspan="3" class="input-field"></td>
              <td colspan="2" class="input-field"></td>
            </tr>
            <!-- add more rows if needed -->
          </tbody>
        </table>

      </td>

      <!-- RIGHT COLUMN -->
      <td class="right-col">

        <!-- Photo and basic info block -->
        <table class="section-table">
          <tr>
            <th style="text-align:center;">写真</th>
          </tr>
          <tr>
            <td style="text-align:center;">
              <div class="photo-box">
                <!-- Replace src with dynamic image path if using Blade -->
                <!-- <img src="{{ public_path($cv->foto) }}" alt="Foto"> -->
                写真をはる位置<br><small>縦36〜40mm、横24〜30mm</small>
              </div>
              <div style="font-size:12px; margin-top:6px; text-align:left;">
                写真の貼り方の注意：本人単身胸から上、裏面のりづけ
              </div>
            </td>
          </tr>
        </table>

        <!-- License / Qualifications -->
        <table class="section-table" style="margin-top:12px;">
          <thead>
            <tr>
              <th colspan="2">年・月</th>
              <th>免許・資格</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td class="year-col">年</td>
              <td class="month-col">月</td>
              <td class="content-col">〇〇〇〇〇 取得</td>
            </tr>
            <tr>
              <td class="year-col">年</td>
              <td class="month-col">月</td>
              <td class="content-col">〇〇〇〇〇 取得</td>
            </tr>
            <!-- empty rows -->
            <tr><td class="year-col"></td><td class="month-col"></td><td class="content-col"></td></tr>
            <tr><td class="year-col"></td><td class="month-col"></td><td class="content-col"></td></tr>
          </tbody>
        </table>

        <!-- Skills / Experience -->
        <table class="section-table" style="margin-top:12px;">
          <thead>
            <tr>
              <th style="width:50%;">特技・経験</th>
              <th style="width:25%;">応募職種</th>
              <th style="width:25%;">利き手</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td rowspan="4" class="section-content">
                <div style="margin-bottom:10px;">
                  <strong>【やってきた作業】</strong>
                  <div>〇〇、〇〇、〇〇、〇〇</div>
                </div>
                <div style="margin-bottom:10px;">
                  <strong>【扱ってきた材料】</strong>
                  <div>〇〇、〇〇、〇〇、〇〇</div>
                </div>
                <div style="margin-bottom:10px;">
                  <strong>【やってきた現場】</strong>
                  <div>〇〇、〇〇、〇〇、〇〇</div>
                </div>
                <div>
                  <strong>【操作できる重機】</strong>
                  <div>〇〇、〇〇、〇〇、〇〇</div>
                </div>
              </td>
              <td style="text-align:center; vertical-align:middle;">左・右</td>
              <td style="text-align:center; vertical-align:middle;">左・右</td>
            </tr>

            <tr style="background:#e3f2fd;">
              <td style="text-align:center;">矯正視力</td>
              <td style="text-align:center;">聴力</td>
            </tr>
            <tr>
              <td style="text-align:center;">有・無</td>
              <td style="text-align:center;">有・無</td>
            </tr>
            <tr>
              <td colspan="2" style="text-align:center; background:#c8e6ff;">宗教</td>
            </tr>

            <tr>
              <td rowspan="3" class="no-border-top"></td>
              <td colspan="2" style="text-align:center; padding:12px;">〇〇〇数</td>
            </tr>
            <tr>
              <td colspan="2" style="text-align:center; background:#e3f2fd; padding:8px;">趣味</td>
            </tr>
            <tr>
              <td colspan="2" style="padding:12px;"></td>
            </tr>
          </tbody>
        </table>

        <!-- Comments -->
        <table class="section-table comment-table" style="margin-top:12px;">
          <tr>
            <th style="text-align:center;">コメント</th>
          </tr>
          <tr>
            <td></td>
          </tr>
        </table>

        <div class="notes">
          <strong>注意:</strong>
          <div class="small-text">この用紙は面談情報として使用します。採用·配置に関する最終判断は会社に帰属します。</div>
        </div>

      </td>
    </tr>
  </table>
</body>
</html>
