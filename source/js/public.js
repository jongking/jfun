/**
 * Created by Administrator on 2015/1/7.
 */
function GetTailNum(S) {
    var i = 1;

    while (isnum(Right(S, i))) {
        i = i + 1;
    }

    return Right(S, (i - 1));
}

/**
 * @return {null}
 * @return {string}
 */
function Right(mainStr, lngLen) {
    if (mainStr.length - lngLen >= 0 && mainStr.length >= 0 && mainStr.length - lngLen <= mainStr.length) {
        return mainStr.substring(mainStr.length - lngLen, mainStr.length);
    }
    else {
        return null;
    }
}

/* 检查是否数字 */
function isnum(str) {
    var pass = false;
    if ($.trim(str).length > 0) {
        if (!isNaN(str)) {
            pass = true;
        }
    }
    return pass;
}