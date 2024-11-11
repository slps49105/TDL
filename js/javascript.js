function phpSel(urlSel, dataKey1, dataVal1, dataKey2, dataVal2) {
    $.ajax({
        type: "POST",
        url: urlSel,
        dataType: "json",
        data: {
            [dataKey1]: dataVal1,
            [dataKey2]: dataVal2
        }
    });
}

function sendSel(dataParam) {
    $.ajax({
        type: "POST",
        url: "func/insert.php",
        dataType: "json",
        data: {
            [dataParam]: $(".insert").val()  // 動態指定要傳送的資料參數名稱
        }
    });
}

function contentSel(Sel, Del, Sel2, Del2, showClass, hideClass) {
    $(".content-main").addClass(Sel).removeClass(Del);
    $(".add").addClass(Sel2).removeClass(Del2);
    $(showClass).show();
    $(hideClass).hide();
}

function addSel(data1, data2, data3) {
    $(data1).hide();
    $(data2).append(`
        <div class="`+ data3 + `">
            <input type="text" class="insert" name="insert">
            <input type="submit" class="sure" value="確定">
            <input type="submit" class="cancel2" name="cancel" value="取消">
        </div>   
    `)
}
$(document).ready(function () {
    $('.hidden').hide();
    $('.day').show();
    $(".content-main").addClass("dy");
    $(".add").addClass("dyadd");

    $('.daily').click(function () {
        contentSel("dy", "wy my iy", "dyadd", "wyadd myadd iyadd", ".day", ".D")
    });
    $('.weekly').click(function () {
        contentSel("wy", "dy my iy", "wyadd", "dyadd myadd iyadd", ".week", ".W")
    });
    $('.monthly').click(function () {
        contentSel("my", "dy wy iy", "myadd", "dyadd wyadd iyadd", ".month", ".M")
    });
    $('.irregularly').click(function () {
        contentSel("iy", "dy wy my", "iyadd", "dyadd wyadd myadd", ".irregular", ".I")
    });

    $(".content-main").on('click', ".dyadd, .wyadd, .myadd", function () {
        const className = $(this).attr("class").split(' ')[1]; // this為被點擊的對象,attr("class")取得該對象的所有class,split把每個class用空格做區隔,[1]選擇第二個class(0為第一個，以此類推)
        const target = className.slice(0, 2); // 取得className前兩個字母(0到2之前)
        const section = target === "dy" ? ".day" : target === "wy" ? ".week" : ".month";
        const section2 = target === "dy" ? "day" : target === "wy" ? "week" : "month";
        addSel(`.${className}`, section, section2);
    });

    $(".content-main").on('click', ".iyadd", function(){
        $(".iyadd").hide();
        $(".irregular").append(`
            <div class="irregular">
                <input type="text" class="insert" name="insert">
                <input type="datetime-local" class="deadline" name="deadline">
                <input type="submit" class="sure" value="確定">
                <input type="submit" class="cancel2" name="cancel" value="取消">
            </div>  
        `)
    })

    $(".day, .week, .month").on('click', ".sure", function () {
        const parentClass = $(this).closest("div").attr("class"); // 取得父元素的 class
        const insertType = parentClass.charAt(0).toUpperCase() + "insert"; // 取父元素的首字母並加上 "insert"
        sendSel(insertType);
    });

    $(".irregular").on('click', ".sure", function () {
        $.ajax({
            type: "POST",
            url: "func/Iinsert.php",
            dataType: "json",
            data: {
                Iinsert: $(".insert").val(),
                deadline: $(".deadline").val()
            }
        });
    });

    $(".labels").on('click', ".cancel", function () {
        $(".tem, #dateup").remove();
        $(".update, .delete").show();
    });

    $(window).scroll(function () {
        var scrollPosition = $(window).scrollTop();
        if (scrollPosition > 200) {
            $('.header').addClass('white').removeClass('vh3');
        } else {
            $('.header').addClass('vh3').removeClass('white');
        }
    });

    setInterval(() => {
        const now = new Date();
        document.getElementById('clock').textContent = now.toLocaleTimeString();
        if (now.getHours() === 0 && now.getMinutes() === 0 && now.getSeconds() === 0) {
            location.reload();
        }
    }, 1000);
})
