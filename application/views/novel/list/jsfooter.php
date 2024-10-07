        <tr id="tr1"></tr>
        <tr id="tr2"></tr>
        <tr id="tr3"></tr>
        <tr id="tr4"></tr>
        <tr id="tr5"></tr>
        <tr id="tr6"></tr>
        <tr id="tr7"></tr>
        <tr id="tr8"></tr>
        <tr id="tr9"></tr>
        <tr id="tr10"></tr>
        </table>
    </div>
    <div class="pagebtn">
        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <li class="page-item" id="prevli">
                    <div id="prev" class="page-link" href="" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </div>
                </li>
                <li class="page-item" id="page1"></li>
                <li class="page-item" id="page2"></li>
                <li class="page-item" id="page3"></li>
                <li class="page-item" id="page4"></li>
                <li class="page-item" id="page5"></li>
                <li class="page-item" id="nextli">
                    <div id="next" class="page-link" href="" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </div>
                </li>
            </ul>
        </nav>
    </div>
</div>
<style type="text/css">
    .page-item:hover{
        cursor: pointer;
    }
</style>
<script type="text/javascript">
    const obj = <?=json_encode($novels)?>;
    $('#novellisttablelist').load('<?=base_url()?>novel/jslist/0',{'novels':obj});
</script>