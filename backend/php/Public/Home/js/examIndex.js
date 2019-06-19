$(function () {
    //通过ajax传送当前选择值
    $('input:radio').click(function () {
        $.post(
            "{:U('saveStatus')}",
            {
                id: $(this).attr('class'),
                choose: $(this).val()
            },
            function (res) {
                console.log(res);
            });
    })



    //将已经选择的答题卡选项变颜色  刷新后依旧存在
    $("input[type=radio]:checked").each(function (j) {
        if (j >= 0) {

            var cardLi = $('a[href=#' + 'qu_0_' + $(this).attr('class') + ']'); // 根据题目ID找到对应答题卡
            // 设置已答题
            if (!cardLi.hasClass('hasBeenAnswer')) {
                cardLi.addClass('hasBeenAnswer');
            }

            $(this).next().css('background-color', '#fff6ce');
        }
    });

    //答题卡
    $('li.option label').click(function () {
        // debugger;
        $(this).css('background-color', '#fff6ce');
        $(this).parent().siblings().children('label').css('background-color', '#fff');
        var examId = $(this).closest('.test_content_nr_main').closest('li').attr('id'); //得到题目ID
        var cardLi = $('a[href=#' + examId + ']'); // 根据题目ID找到对应答题卡
        // 设置已答题
        if (!cardLi.hasClass('hasBeenAnswer')) {
            cardLi.addClass('hasBeenAnswer');
        }
    });
})