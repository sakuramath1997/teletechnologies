class ClassToggler {
    constructor() {
      this.eventListeners = []; // イベントリスナーの履歴
      this.observeDOMChanges(); // DOMの変化を監視
    }
  
    // イベント発火時にIDを持つ要素にクラスを追加
    addClassById(id, eventName, classNames) {
      this._addRemoveClassById(id, eventName, classNames, 'add');
    }
  
    // イベント発火時にIDを持つ要素からクラスを削除
    removeClassById(id, eventName, classNames) {
      this._addRemoveClassById(id, eventName, classNames, 'remove');
    }
  
    // イベント発火時にクラス名を持つ要素にクラスを追加
    addClassByClassName(targetClass, eventName, classNames) {
      this._addRemoveClassByClassName(targetClass, eventName, classNames, 'add');
    }
  
    // イベント発火時にクラス名を持つ要素からクラスを削除
    removeClassByClassName(targetClass, eventName, classNames) {
      this._addRemoveClassByClassName(targetClass, eventName, classNames, 'remove');
    }
  
    // クラス追加・削除の基本メソッド (ID用)
    _addRemoveClassById(id, eventName, classNames, action) {
      const element = document.getElementById(id);
      if (element) {
        this._addEventListener(element, eventName, classNames, action);
      }
    }
  
    // クラス追加・削除の基本メソッド (クラス名用)
    _addRemoveClassByClassName(targetClass, eventName, classNames, action) {
      const elements = document.querySelectorAll(`.${targetClass}`);
      elements.forEach(element => {
        this._addEventListener(element, eventName, classNames, action);
      });
    }
  
    // イベントリスナーの設定
    _addEventListener(element, eventName, classNames, action) {
      // classNamesが配列である場合に対応
      if (Array.isArray(classNames)) {
        classNames.forEach(className => {
          const listener = () => {
            if (action === 'add') {
              element.classList.add(className);
            } else if (action === 'remove') {
              element.classList.remove(className);
            }
          };
          element.addEventListener(eventName, listener);
          this.eventListeners.push({ element, eventName, listener, className });
        });
      } else {
        const listener = () => {
          if (action === 'add') {
            element.classList.add(classNames);
          } else if (action === 'remove') {
            element.classList.remove(classNames);
          }
        };
        element.addEventListener(eventName, listener);
        this.eventListeners.push({ element, eventName, listener, className: classNames });
      }
    }
  
    // DOMの変化を監視して、条件に合う要素に適用する
    observeDOMChanges() {
      const observer = new MutationObserver(mutations => {
        mutations.forEach(mutation => {
          if (mutation.type === 'childList') {
            mutation.addedNodes.forEach(node => {
              if (node.nodeType === 1) { // DOM要素
                // 追加されたDOM要素に対して適用する
                this.eventListeners.forEach(listener => {
                  if (node.id === listener.element.id || node.classList.contains(listener.element.className)) {
                    listener.element.addEventListener(listener.eventName, listener.listener);
                  }
                });
              }
            });
          }
        });
      });
  
      // 監視対象を設定 (body以下の全てのDOM変更)
      observer.observe(document.body, { childList: true, subtree: true });
    }
  
    // カスタムイベントをリッスン
    listenToCustomEvents() {
      window.addEventListener('scrollUpStarted', () => {
        console.log('上方向スクロール開始');
      });
  
      window.addEventListener('scrollDownStarted', () => {
        console.log('下方向スクロール開始');
      });
    }
  }
  