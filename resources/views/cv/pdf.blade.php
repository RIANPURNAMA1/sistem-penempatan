<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>面談シート</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: "MS Mincho", "ヒラギノ明朝 Pro", serif;
            background-color: #fff;
            padding: 20px;
            font-size: 12px;
        }
        
        .container {
            max-width: 900px;
            margin: 0 auto;
            border: 1px solid #000;
            padding: 15px;
        }
        
        .title {
            text-align: right;
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 10px;
        }
        
        .date-line {
            text-align: right;
            margin-bottom: 15px;
            font-size: 11px;
        }
        
        .main-section {
            border: 1px solid #000;
            margin-bottom: 10px;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
        }
        
        td, th {
            border: 1px solid #000;
            padding: 4px 6px;
            font-size: 11px;
            vertical-align: middle;
        }
        
        .label-cell {
            background-color: #f0f0f0;
            font-weight: bold;
            text-align: center;
            white-space: nowrap;
        }
        
        .photo-box {
            width: 100px;
            height: 130px;
            border: 1px solid #000;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            font-size: 9px;
            text-align: center;
            line-height: 1.4;
            padding: 5px;
        }
        
        .note-section {
            border: 1px solid #000;
            padding: 8px;
            margin-bottom: 10px;
            font-size: 10px;
            line-height: 1.6;
        }
        
        .note-title {
            font-weight: bold;
            margin-bottom: 5px;
        }
        
        .vertical-text {
            writing-mode: vertical-rl;
            text-orientation: upright;
            padding: 5px;
        }
        
        .small-text {
            font-size: 10px;
        }
        
        .underline-space {
            border-bottom: 1px solid #000;
            display: inline-block;
            min-width: 60px;
        }
        
        .section-header {
            background-color: #e8e8e8;
            font-weight: bold;
            text-align: center;
            padding: 5px;
        }
        
        .no-border-right {
            border-right: none;
        }
        
        .no-border-left {
            border-left: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Title and Date -->
        <div class="title">面談シート</div>
        <div class="date-line">
            <span class="underline-space">&nbsp;&nbsp;&nbsp;&nbsp;</span>年
            <span class="underline-space">&nbsp;&nbsp;&nbsp;</span>月
            <span class="underline-space">&nbsp;&nbsp;&nbsp;</span>日現在
        </div>
        
        <!-- Notes Section -->
        <div class="note-section">
            <div class="note-title">記入上の注意</div>
            <div>1．鉛筆以外の黒又は青の筆記具で記入。 2．数字はアラビア数字で、文字はくずさず正確に書く。</div>
            <div>3．※印のところは、該当するものを○で囲む。</div>
        </div>
        
        <!-- Main Information Section -->
        <div class="main-section">
            <table>
                <tr>
                    <td colspan="2" class="label-cell" style="width: 15%;">ふりがな</td>
                    <td colspan="3"></td>
                    <td rowspan="2" style="width: 110px; text-align: center; padding: 0;">
                        <div class="photo-box">
                            <div style="font-weight: bold; margin-bottom: 5px;">写真をはる位置</div>
                            <div style="font-size: 8px;">写真をはる必要が<br>ある場合</div>
                            <div style="font-size: 8px; margin-top: 5px;">
                                1．縦 36～40mm<br>
                                　横 24～30mm<br>
                                2.本人単身胸から上<br>
                                3.裏面のりづけ
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" class="label-cell">氏　名</td>
                    <td colspan="3" style="font-size: 14px; font-weight: bold;">Aldi abduloh</td>
                </tr>
                <tr>
                    <td class="label-cell" style="width: 10%;">国籍</td>
                    <td style="width: 15%;">インドネシア</td>
                    <td class="label-cell" style="width: 10%;">生年月日</td>
                    <td style="width: 18%;">2001年 06月 06日</td>
                    <td class="label-cell" style="width: 8%;">年齢</td>
                    <td style="width: 12%;">〇歳</td>
                    <td class="label-cell" style="width: 8%;">性別</td>
                    <td>男 ・ 女</td>
                </tr>
            </table>
        </div>
        
        <!-- Address Section -->
        <div class="main-section">
            <table>
                <tr>
                    <td rowspan="2" class="label-cell" style="width: 8%; writing-mode: vertical-rl;">ふりがな</td>
                    <td rowspan="2" class="label-cell" style="width: 8%; writing-mode: vertical-rl;">現住所</td>
                    <td style="height: 25px;">〒</td>
                </tr>
                <tr>
                    <td>〇〇県〇〇市</td>
                </tr>
                <tr>
                    <td class="label-cell">在留資格</td>
                    <td>―</td>
                    <td class="label-cell">在留期限</td>
                    <td>―</td>
                </tr>
            </table>
        </div>
        
        <!-- Physical Information Section -->
        <div class="main-section">
            <table>
                <tr>
                    <td class="label-cell" style="width: 12%;">血液型</td>
                    <td style="width: 13%;">〇型</td>
                    <td class="label-cell" style="width: 12%;">服サイズ</td>
                    <td style="width: 13%;">S/M/L/XL</td>
                    <td class="label-cell" style="width: 12%;">結婚</td>
                    <td style="width: 13%;">既婚・未婚</td>
                    <td class="label-cell" style="width: 12%;">矯正視力</td>
                    <td>有・無</td>
                </tr>
                <tr>
                    <td class="label-cell">身長</td>
                    <td>〇cm</td>
                    <td class="label-cell">ズボンサイズ</td>
                    <td>S/M/L/XL</td>
                    <td class="label-cell" rowspan="2" style="writing-mode: vertical-rl;">家族構成</td>
                    <td rowspan="2" style="font-size: 10px;">
                        自分・母・父・妻・子供(〇人)<br>
                        兄(〇人)・姉(〇人)<br>
                        弟(〇人)・妹(〇人)
                    </td>
                    <td class="label-cell">聴力異常</td>
                    <td>有・無</td>
                </tr>
                <tr>
                    <td class="label-cell">体重</td>
                    <td>〇kg</td>
                    <td class="label-cell">靴サイズ</td>
                    <td></td>
                    <td class="label-cell">宗教</td>
                    <td>〇〇〇教</td>
                </tr>
            </table>
        </div>
        
        <!-- Skills Section -->
        <div class="main-section">
            <table>
                <tr class="text-center">
                    <td class="label-cell" style="width: 15%;">特技・経験</td>
                    <td style="width: 35%;"></td>
                    <td class="label-cell" style="width: 15%;">応募職種</td>
                    <td style="width: 20%;"></td>
                    <td class="label-cell" style="width: 15%;">利き手</td>
                    <td>左・右</td>
                </tr>
                <tr class="d-flex justify-between">
                    <td class="label-cell">趣味</td>
                    <td colspan="5"></td>
                </tr>
            </table>
        </div>
        
        <!-- Education History -->
        <div class="main-section">
            <table>
                <tr>
                    <td colspan="3" class="section-header">学　歴</td>
                </tr>
                <tr>
                    <td class="label-cell" style="width: 20%;">年・月</td>
                    <td class="label-cell" style="width: 50%;">学　歴</td>
                    <td class="label-cell" style="width: 30%;">学部・学科</td>
                </tr>
                <tr>
                    <td>〇〇〇〇年06月</td>
                    <td>〇〇〇〇〇〇小学校</td>
                    <td style="text-align: center;">卒業</td>
                </tr>
                <tr>
                    <td>〇〇〇〇年06月</td>
                    <td>〇〇〇〇〇〇中学校</td>
                    <td style="text-align: center;">卒業</td>
                </tr>
                <tr>
                    <td class="text-white">〇〇〇〇年06月</td>
                    <td>〇〇〇〇〇〇高等学校</td>
                    <td style="text-align: center;">卒業</td>
                </tr>
            </table>
        </div>xam
        
        <!-- Work History -->
        <div class="main-section">
            <table>
                <tr>
                    <td colspan="3" class="section-header">職　歴</td>
                </tr>
                <tr>
                    <td class="label-cell" style="width: 20%;">年・月</td>
                    <td class="label-cell" style="width: 50%;">職　歴</td>
                    <td class="label-cell" style="width: 30%;">職種</td>
                </tr>
                <tr>
                    <td>〇〇〇〇年〇〇月～<br>〇〇〇〇年〇〇月</td>
                    <td>株式会社〇〇〇〇〇〇</td>
                    <td style="text-align: center;">退職</td>
                </tr>
                <tr>
                    <td>〇〇〇〇年〇〇月～<br>〇〇〇〇年〇〇月</td>
                    <td></td>
                    <td></td>
                </tr>
            </table>
        </div>
        
        <!-- License & Qualifications -->
        <div class="main-section">
            <table>
                <tr>
                    <td colspan="3" class="section-header">免許・資格</td>
                </tr>
                <tr>
                    <td class="label-cell" style="width: 20%;">年・月</td>
                    <td class="label-cell" colspan="2">免許・資格</td>
                </tr>
                <tr>
                    <td><span class="underline-space">&nbsp;&nbsp;&nbsp;&nbsp;</span>年<span class="underline-space">&nbsp;&nbsp;</span>月</td>
                    <td colspan="2">〇〇〇〇〇〇　取得</td>
                </tr>
                <tr>
                    <td><span class="underline-space">&nbsp;&nbsp;&nbsp;&nbsp;</span>年<span class="underline-space">&nbsp;&nbsp;</span>月</td>
                    <td colspan="2">〇〇〇〇〇〇　取得</td>
                </tr>
            </table>
        </div>
        
        <!-- Comments Section -->
        <div class="main-section">
            <table>
                <tr>
                    <td class="label-cell" style="text-align: center; padding: 10px;">コメント</td>
                    <td style="padding: 10px;">
                        <div style="margin-bottom: 8px;"><strong>【やってきた作業】</strong><br>〇〇、〇〇、〇〇、〇〇</div>
                        <div style="margin-bottom: 8px;"><strong>【扱ってきた材料】</strong><br>〇〇、〇〇、〇〇、〇〇</div>
                        <div style="margin-bottom: 8px;"><strong>【やってきた現場】</strong><br>〇〇、〇〇、〇〇、〇〇</div>
                        <div><strong>【操作できる重機】</strong><br>〇〇、〇〇、〇〇、〇〇</div>
                    </td>
                </tr>
            </table>
        </div>
        
        <!-- Additional Section -->
        <div class="main-section">
            <table>
                <tr>
                    <td class="label-cell" style="width: 20%; text-align: center;">国外・国内</td>
                    <td style="width: 30%;"></td>
                    <td class="label-cell" style="width: 20%; text-align: center;">国外・国内</td>
                    <td style="width: 30%;"></td>
                </tr>
            </table>
        </div>
    </div>
</body>
</html>