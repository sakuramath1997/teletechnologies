// カスタムイベントの定義


// 基本的には，ScrollManager と併用することを想定しています。
// スクロールを通知するイベント
const scrollDirectionChangedEvent = new CustomEvent('scrollDirectionChanged', {
    detail: { direction: null }
});
// 上方向スクロールを通知するイベント
const scrollUpStartedEvent = new CustomEvent('scrollUpStarted');
// 下方向スクロールを通知するイベント
const scrollDownStartedEvent = new CustomEvent('scrollDownStarted');


class ScrollManager {
    constructor() {
        this._scrollAmount = window.scrollY;     // 現在のスクロール量
        this._scrollDirection = null;            // 直近のスクロール方向
        this._previousScroll = window.scrollY;   // 前回のスクロール位置
        // スクロール方向変更イベントのリスナーを設定
        window.addEventListener('scrollDirectionChanged', this._handleDirectionChange.bind(this));
        // スクロールイベントのリスナーを設定
        window.addEventListener('scroll', this._handleScroll.bind(this));
    }
    // 現在のスクロール量を取得するゲッター
    get scrollAmount() {
        return this._scrollAmount;
    }
    // 直近のスクロール方向を取得するゲッター
    get scrollDirection() {
        return this._scrollDirection;
    }
    // スムーズスクロールメソッド
    scrollTo(targetY, duration = 500) {
        const startY = window.scrollY;
        const distance = targetY - startY;
        let startTime = null;
        const animateScroll = (currentTime) => {
            if (!startTime) startTime = currentTime;
            const timeElapsed = currentTime - startTime;
            const progress = Math.min(timeElapsed / duration, 1);
            window.scrollTo(0, startY + distance * progress);
            if (timeElapsed < duration) {
                requestAnimationFrame(animateScroll);
            }
        };
        requestAnimationFrame(animateScroll);
    }
    // スクロール方向が変更された場合にカスタムイベントを発火
    _handleScroll() {
        const currentScroll = window.scrollY;
        const newDirection = currentScroll > this._previousScroll ? 'down' : 'up';
        // 方向が変更された場合のみカスタムイベントを発火
        if (this._scrollDirection !== newDirection) {
            this._scrollDirection = newDirection;
            this._previousScroll = currentScroll;
            // スクロール方向が変更されたことを通知
            window.dispatchEvent(new CustomEvent('scrollDirectionChanged', {
                detail: { direction: this._scrollDirection }
            }));
        }
        this._previousScroll = currentScroll;
    }
    // スクロール方向変更を受けて適切にカスタムイベントを発火
    _handleDirectionChange(event) {
        const direction = event.detail.direction;
        if (direction === 'up') {
        // 上方向のスクロールが開始された場合、scrollUpStartedイベントを発火
        window.dispatchEvent(scrollUpStartedEvent);
        } else if (direction === 'down') {
        // 下方向のスクロールが開始された場合、scrollDownStartedイベントを発火
        window.dispatchEvent(scrollDownStartedEvent);
        }
    }
}