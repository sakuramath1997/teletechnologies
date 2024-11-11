class EventListner {
    constructor(event, functions) {
        this._event = event; //イベント
        this._functions = functions; //函数
        window.addEventListener( this._event, (e) => {
            this._functions.forEach( (_function) => {
                _function(e);
            });
        })
    }
}