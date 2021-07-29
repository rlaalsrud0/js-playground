// html elements
var word1 = document.getElementById('word1');  //answer
var word2 = document.getElementById('word2');  //buttons
var check = document.getElementById('check');  //word1 === word2?
var progress = document.getElementById('progress');  //progress check
var time = document.getElementById('time');

//game objects
var game = { 
    'btns': [],
    'maxPlay' : 3,
    'current' : 0
};


function doFetchGet() {
    return (fetch ('./index.php',{
        method : 'POST',
        headers : {
            'Content-Type' : 'application / json'
    }
    })
    .then(function (response) {
        console.log(response);
        return response.text();
    })
    .catch(function(error){
        return error;
    }));
}

async function fetchAfterGet(event){
    console.log(event);           
    var data = await doFetchGet(event);
    //console.log(data);
    var i = data.split("\r\n");
    game.words  = i;
    game.words.pop();
    //document.querySelector('article').innerHTML = i;
    console.log(game.words);
    game.init();
    game.shuffle();
    game.startTime = Date.now();
    x = setInterval(updateTime, 50);
}


//choose 1 word from words
game.choose = function () {
    var idx = Math.floor(Math.random() * this.words.length);
    this.answer = this.words[idx];
    this.letters = this.answer.split('');
    word1.innerHTML = this.answer;
};

game.addButtons = function () {
    for (var i = 0; i < this.letters.length; i++) {
        var btn = document.createElement('button');
        btn.innerHTML = this.letters[i];
        word2.appendChild(btn);
        this.btns.push(btn);
    }
};


// 단어 하나 끝나고 초기화
game.removeButtons = function(){
    for(var i = 0; i < this.btns.length; i++){
        word2.removeChild(this.btns[i]);
    }
    this.btns = [];
};
// 맞춘 단어 버튼을 합쳐서 원래의 답과 일치한지 확인
game.checkGood = function(){
    return this.answer === this.letters.join('');
};
// 일치한지 확인하고 일치하면 일치, 아니면 불일치
game.updateDisplay = function () {
    if (this.checkGood()) {
        check.innerHTML = '일치합니다.';
    } else {
        check.innerHTML = '일치하지 않습니다.';
    }
};
// 초기화함수 정의
game.init = function () {
    this.choose();
    this.addButtons();
    this.updateDisplay();
    //var x = setInterval(updateTime, 50);

};
//초기화 함수 호출
//game.init();

// 버튼에 쪼갠 단어를 하나씩 대입
game.copyBtnText = function () {
    for (var i = 0; i < this.letters.length; i++) {
        this.btns[i].innerHTML = this.letters[i];
    }
};
// 뒤집기
game.swap = function(){
    var temp = [];
    while (game.letters.length != 0) {
        var s = game.letters.pop();
        temp.push(s);
    }
    game.letters = temp;
    game.copyBtnText();
    game.updateDisplay();
};
// 오른쪽 밀기
game.rshift = function(){
    var s = game.letters.pop();
    game.letters.unshift(s);
    game.copyBtnText();
    game.updateDisplay();
};
// 왼쪽 밀기
game.lshift = function(){
    var s = game.letters.shift();
    game.letters.push(s);
    game.copyBtnText();
    game.updateDisplay();
};
var x = 0;
// 맞췄으면 O표시
game.progress = function(){
    if(game.checkGood()){
        game.current++;
        game.removeButtons();
        game.init();
        game.shuffle();
        var str = "";
        for(var i = 0; i < game.current; i++){
            str += "O";
        }
        progress.innerHTML = str;
    }

    if(game.current === game.maxPlay){
        var sec = (Date.now() - game.startTime) / 1000;
        alert("Good! Your Record : " + sec + " sec");
        passVal(sec);
        //inputname();
        clearInterval(x);
    }
};

function passVal(time){
    console.log(time);
    //sendDataToServer(time);
    var input = confirm("이름을 입력하시겠습니까?");
    if(input === true){
        var inputString = prompt('이름을 입력하세요', '김민경'); 
        sendDataToServer(time,inputString);
    }
}
function sendDataToServer(time, inputString) {
    var formData = new FormData();
    formData.append("time", time);
    formData.append("name", inputString);
    fetch("./get_data.php", {
        method: "POST",
        body: formData
        
    })
        .then(function (response) {
            return response.text();
        })
        .then(function (data) {
            console.log(data);
        })
        .catch((data) => {
            console.log(data);
        });
        getVal();
}

function Get() {
    return (fetch ('./rank.php',{
        method : 'POST',
        headers : {
            'Content-Type' : 'application / json'
    }
    })
    .then(function (response) {
        console.log(response);
        return response.text();
    })
    .catch(function(error){
        return error;
    }));
}

async function getVal(event){
    console.log(event);           
    var data = await Get(event);
    console.log(data);
    //alert(data);
    document.write(data);
}


//event handler for swap button
var swap = function () {
    game.swap();
    game.progress();
};

var rshift = function () {
    game.rshift();
    game.progress();
};

var lshift = function () {
    game.lshift();
    game.progress();
};

//shuffle    똑같은 단어 또 나오지 않게 섞는거
game.shuffle = function () {
    var toggle = Math.floor(Math.random() * 2) === 0;
    if (toggle) {
        game.swap();
    }

    var rmax = Math.max(game.answer.length - 1, 1);
    var n = Math.floor(Math.random() * rmax) + 1;
    for (var i = 0; i < n; i++) {
        game.rshift();
    }
};
//game.shuffle();

var updateTime = function(){
    var now = Date.now() - game.startTime;
    time.innerHTML = (now / 1000) + " s";
};

//var x = setInterval(updateTime, 50);