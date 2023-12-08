var step = 1;

function change() {
    var r1 = document.getElementById('r1');
    var r2 = document.getElementById('r2');
    var r3 = document.getElementById('r3');
    var r4 = document.getElementById('r4');

    r1.checked = false;
    r2.checked = false;
    r3.checked = false;
    r4.checked = false;

    switch (step) 
    {
        case 1:
            r1.checked = true;
            break;
        case 2:
            r2.checked = true;
            break;
        case 3:
            r3.checked = true;
            break;
        case 4:
            r4.checked = true;
            break;
    }

    step = (step % 4) + 1;
}

setInterval(change, 6000);