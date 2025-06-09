export default class ItcTabs {
	constructor(target, config){
		const defaultConfig = {};
		this._config = Object.assign(defaultConfig, config);
		this._elTabs = typeof target === 'string' ? document.querySelector(target):target;
		this._elButtons = this._elTabs.querySelectorAll('.tabs__btn');
		this._elPanes = this._elTabs.querySelectorAll('.tabs__pane');

		if(!this._elTabs)
		{
			return;
		}

		this._init();
		this._events();
	}

	_init(){
		this._elTabs.setAttribute('role', 'tablist');
		this._elButtons.forEach((el, index) => {
			el.dataset.index = index;
			el.setAttribute('role', 'tab');
			this._elPanes[index].setAttribute('role', 'tabpanel');
		});
	}

	show(elLinkTarget){
		const elPaneTarget = this._elPanes[elLinkTarget.dataset.index];
		const elLinkActive = this._elTabs.querySelector('.tabs__btn_active');
		const elPaneShow = this._elTabs.querySelector('.tabs__pane_show');
		if(elLinkTarget === elLinkActive)
		{
			return;
		}
		this._paneFrom = elPaneShow;
		this._paneTo = elPaneTarget;
		elLinkActive ? elLinkActive.classList.remove('tabs__btn_active'):null;
		elPaneShow ? elPaneShow.classList.remove('tabs__pane_show'):null;
		elLinkTarget.classList.add('tabs__btn_active');
		elPaneTarget.classList.add('tabs__pane_show');
		this._elTabs.dispatchEvent(new CustomEvent('tab.itc.change', {
			detail: {
				elTab: this._elTabs,
				paneFrom: this._paneFrom,
				paneTo: this._paneTo
			}
		}));
		elLinkTarget.focus();
	}

	showByIndex(index){
		const elLinkTarget = this._elButtons[index];
		elLinkTarget ? this.show(elLinkTarget):null;
	};

	_events(){
		this._elTabs.addEventListener('click', (e) => {
			const target = e.target.closest('.tabs__btn');
			if(target)
			{
				e.preventDefault();
				this.show(target);
			}
		});
	}
}
