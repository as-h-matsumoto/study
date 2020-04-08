
        <?php
        if(isset($license_question_try_master)){
          $license_id = $license_question_try_master->license_id;
          $year = $license_question_try_master->license_year;
        }else{
          /*
          $license_id
          $year
          を渡して表示
          */
        }
        ?>

        <div class="row">
        <div class="col-sm-6 card py-8">
            <div class="card-title px-2">
               <p class="center">一次試験</p>
            </div>
            <div class="card-body">
            <table class="a">
                <thead>
                    <tr>
                        <th>資料名</th>
                        <th>データ</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td>{!!$year.'年度'!!} 一次試験 案内</td>
                        <td>
                            <a target="_blank" href="/storage/global/license/{!!$license_id!!}/{!!$year!!}/{!!$year!!}_1ji_annai.pdf">案内<i class="icon icon-file-pdf-box"></i></a>
                            <a target="_blank" href="/storage/global/license/{!!$license_id!!}/{!!$year!!}/{!!$year!!}_1ji_toukei.pdf">統計<i class="icon icon-file-pdf-box"></i></a>
                        </td>
                    </tr>
                    <tr>
                        <td>{!!$year.'年度'!!} 一次試験 経済学・経済政策</td>
                        <td><a target="_blank" href="/storage/global/license/{!!$license_id!!}/{!!$year!!}/1jia{!!$year!!}.pdf">問<i class="icon icon-file-pdf-box"></i></a>
                            <a target="_blank" href="/storage/global/license/{!!$license_id!!}/{!!$year!!}/1jiakai{!!$year!!}.pdf">解<i class="icon icon-file-pdf-box"></i></a>
                        </td>
                    </tr>
                    <tr>
                        <td>{!!$year.'年度'!!} 一次試験 財務・会計</td>
                        <td><a target="_blank" href="/storage/global/license/{!!$license_id!!}/{!!$year!!}/1jib{!!$year!!}.pdf">問<i class="icon icon-file-pdf-box"></i></a>
                            <a target="_blank" href="/storage/global/license/{!!$license_id!!}/{!!$year!!}/1jibkai{!!$year!!}.pdf">解<i class="icon icon-file-pdf-box"></i></a>
                        </td>
                    </tr>
                    <tr>
                        <td>{!!$year.'年度'!!} 一次試験 企業経営理論</td>
                        <td><a target="_blank" href="/storage/global/license/{!!$license_id!!}/{!!$year!!}/1jic{!!$year!!}.pdf">問<i class="icon icon-file-pdf-box"></i></a>
                            <a target="_blank" href="/storage/global/license/{!!$license_id!!}/{!!$year!!}/1jickai{!!$year!!}.pdf">解<i class="icon icon-file-pdf-box"></i></a>
                        </td>
                    </tr>
                    <tr>
                        <td>{!!$year.'年度'!!} 一次試験 運営管理</td>
                        <td><a target="_blank" href="/storage/global/license/{!!$license_id!!}/{!!$year!!}/1jid{!!$year!!}.pdf">問<i class="icon icon-file-pdf-box"></i></a>
                            <a target="_blank" href="/storage/global/license/{!!$license_id!!}/{!!$year!!}/1jidkai{!!$year!!}.pdf">解<i class="icon icon-file-pdf-box"></i></a>
                        </td>
                    </tr>
                    <tr>
                        <td>{!!$year.'年度'!!} 一次試験 経営法務</td>
                        <td><a target="_blank" href="/storage/global/license/{!!$license_id!!}/{!!$year!!}/1jie{!!$year!!}.pdf">問<i class="icon icon-file-pdf-box"></i></a>
                            <a target="_blank" href="/storage/global/license/{!!$license_id!!}/{!!$year!!}/1jiekai{!!$year!!}.pdf">解<i class="icon icon-file-pdf-box"></i></a>
                        </td>
                    </tr>
                    <tr>
                        <td>{!!$year.'年度'!!} 一次試験 経営情報システム</td>
                        <td><a target="_blank" href="/storage/global/license/{!!$license_id!!}/{!!$year!!}/1jif{!!$year!!}.pdf">問<i class="icon icon-file-pdf-box"></i></a>
                            <a target="_blank" href="/storage/global/license/{!!$license_id!!}/{!!$year!!}/1jifkai{!!$year!!}.pdf">解<i class="icon icon-file-pdf-box"></i></a>
                        </td>
                    </tr>
                    <tr>
                        <td>{!!$year.'年度'!!} 一次試験 中小企業経営・中小企業政策</td>
                        <td><a target="_blank" href="/storage/global/license/{!!$license_id!!}/{!!$year!!}/1jic{!!$year!!}.pdf">問<i class="icon icon-file-pdf-box"></i></a>
                            <a target="_blank" href="/storage/global/license/{!!$license_id!!}/{!!$year!!}/1jickai{!!$year!!}.pdf">解<i class="icon icon-file-pdf-box"></i></a>
                        </td>
                    </tr>
                </tbody>
            </table>

            </div>

        </div>



        <div class="col-sm-6 card py-8">
            <div class="card-title px-2">
               <p class="center">二次試験</p>
            </div>
            <div class="card-body">
            <table class="a">
                <thead>
                    <tr>
                        <th>資料名</th>
                        <th>データ</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td>{!!$year.'年度'!!} 二次試験 案内</td>
                        <td>
                            <a target="_blank" href="/storage/global/license/{!!$license_id!!}/{!!$year!!}/{!!$year!!}_2ji_annai.pdf">案内<i class="icon icon-file-pdf-box"></i></a>
                            <a target="_blank" href="/storage/global/license/{!!$license_id!!}/{!!$year!!}/{!!$year!!}_2ji_toukei.pdf">統計<i class="icon icon-file-pdf-box"></i></a>
                        </td>
                    </tr>
                    <tr>
                        <td>{!!$year.'年度'!!} 二次試験 組織</td>
                        <td>
                            <a target="_blank" href="/storage/global/license/{!!$license_id!!}/{!!$year!!}/{!!$year!!}_2ji_shushi_jirei1.pdf">趣旨<i class="icon icon-file-pdf-box"></i></a>
                            <a target="_blank" href="/storage/global/license/{!!$license_id!!}/{!!$year!!}/2jia{!!$year!!}.pdf">問<i class="icon icon-file-pdf-box"></i></a>
                        </td>
                    </tr>
                    <tr>
                        <td>{!!$year.'年度'!!} 二次試験 マーケティング・流通</td>
                        <td>
                            <a target="_blank" href="/storage/global/license/{!!$license_id!!}/{!!$year!!}/{!!$year!!}_2ji_shushi_jirei2.pdf">趣旨<i class="icon icon-file-pdf-box"></i></a>
                            <a target="_blank" href="/storage/global/license/{!!$license_id!!}/{!!$year!!}/2jib{!!$year!!}.pdf">問<i class="icon icon-file-pdf-box"></i></a>
                        </td>
                    </tr>
                    <tr>
                        <td>{!!$year.'年度'!!} 二次試験 生産・技術</td>
                        <td>
                            <a target="_blank" href="/storage/global/license/{!!$license_id!!}/{!!$year!!}/{!!$year!!}_2ji_shushi_jirei3.pdf">趣旨<i class="icon icon-file-pdf-box"></i></a>
                            <a target="_blank" href="/storage/global/license/{!!$license_id!!}/{!!$year!!}/2jic{!!$year!!}.pdf">問<i class="icon icon-file-pdf-box"></i></a>
                        </td>
                    </tr>
                    <tr>
                        <td>{!!$year.'年度'!!} 二次試験 財務・会計</td>
                        <td>
                            <a target="_blank" href="/storage/global/license/{!!$license_id!!}/{!!$year!!}/{!!$year!!}_2ji_shushi_jirei4.pdf">趣旨<i class="icon icon-file-pdf-box"></i></a>
                            <a target="_blank" href="/storage/global/license/{!!$license_id!!}/{!!$year!!}/2jid{!!$year!!}.pdf">問<i class="icon icon-file-pdf-box"></i></a>
                        </td>
                    </tr>
                </tbody>
            </table>
            </div>

        </div>
        </div>