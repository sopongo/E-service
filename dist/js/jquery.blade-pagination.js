/*!
 * Blade Pagination - v1.0.0 - 2016-06-11
 * jQuery Plug-in
 * http://github.com/panfeng-pf/blade-pagination
 * Copyright (c) 2016 Blade Pan; Licensed Apache 2.0
 * Dependency: jQuery (test with jQuery v1.11.2)
 */
(function($) {
	/*==============================================
	 * pagination
	 *==============================================
	 */
	$.fn.bladePagination = function(options) {
		if(typeof(options) === 'object' || typeof(options) === 'undefined') {
			var settings = $.extend({}, $.fn.bladePagination.defaults, options);
			return this.each(function() {
				var jqPagination = $(this);
				if(jqPagination.hasClass('blade-pagination')) {
					createPagination(jqPagination, settings);
					initPageClick(jqPagination, settings);
				}
			});
		}
	};
	
	/*==============================================
	 * default options
	 *==============================================
	 */
	$.fn.bladePagination.defaults = {
		maxPageNum: 5,
		firstLabel: '|&lt;', // |<
		prevLabel: '&lt;',   // <
		nextLabel: '&gt;',   // >
		lastLabel: '&gt;|',  // >|
		moreLabel: '...',
		rebuildAfterClick: false,
		clickPage: function(page, jqPagination) {}
	};
	
	/*==============================================
	 * private functions
	 *==============================================
	 */
	var createPagination = function(jqPagination, settings) {
		var currPage = Number(jqPagination.attr('data-current'));
		var totalPage = Number(jqPagination.attr('data-total'));
		var pageShowArray = new Array();
		
		//first page
		pageShowArray.push({
			type: 'page first' + ((1 == currPage) ? ' disabled' : '')
			, page: 1
			, show: settings.firstLabel
		});
		
		//previous page
		pageShowArray.push({
			type: 'page prev' + ((1 == currPage) ? ' disabled' : '')
			, page: (currPage <= 1) ? 1 : (currPage - 1)
			, show: settings.prevLabel
		});
		
		//page number
		var pageNumArray = new Array();
		var leftPageNum = (settings.maxPageNum - 1) / 2;
		var rightPageNum = settings.maxPageNum - 1 - leftPageNum;
		if(currPage - leftPageNum < 1) {
			for(var i = leftPageNum; i > 0; i --) {
				var page = currPage - i;
				if(page < 1) {
					rightPageNum ++;
				} else {
					pageNumArray.push(page);
				}
			}
			pageNumArray.push(currPage);
			for(var i = 1; i <= rightPageNum; i ++) {
				var page = currPage + i;
				if(page > totalPage) break;
				pageNumArray.push(page);
			}
		} else {
			for(var i = rightPageNum; i > 0; i --) {
				var page = currPage + i;
				if(page > totalPage) {
					leftPageNum ++;
				} else {
					pageNumArray.unshift(page);
				}
			}
			pageNumArray.unshift(currPage);
			for(var i = 1; i <= leftPageNum; i ++) {
				var page = currPage - i;
				if(page < 1) break;
				pageNumArray.unshift(page);
			}
		}
		if(pageNumArray[0] > 1) {
			pageShowArray.push({
				type: 'more'
				, page: -1
				, show: settings.moreLabel
			});
		}
		for(var i = 0; i < pageNumArray.length; i ++) {
			var pageNum = pageNumArray[i];
			pageShowArray.push({
				type: 'page' + ((pageNum == currPage) ? ' active' : '')
				, page: pageNum
				, show: pageNum
			});
		}
		if(pageNumArray[pageNumArray.length - 1] < totalPage) {
			pageShowArray.push({
				type: 'more'
				, page: -1
				, show: settings.moreLabel
			});
		}
		
		//next page
		pageShowArray.push({
			type: 'page next' + ((totalPage == currPage) ? ' disabled' : '')
			, page: (currPage >= totalPage) ? totalPage : (currPage + 1)
			, show: settings.nextLabel
		});
		
		//last page
		pageShowArray.push({
			type: 'page last' + ((totalPage == currPage) ? ' disabled' : '')
			, page: totalPage
			, show: settings.lastLabel
		});
		
		//create page
		jqPagination.empty();
		for(var i = 0; i < pageShowArray.length; i ++) {
			var pageShow = pageShowArray[i];
			var html = '<li class="' + pageShow.type + '" data-page="' + pageShow.page + '">' + pageShow.show + '</li>';
			jqPagination.append(html);
		}
	}
	
	var initPageClick = function(jqPagination, settings) {
		var jqPageSet = jqPagination.find('li.page');
		
		//event handler
		jqPageSet.off('click');
		jqPageSet.click(function() {
			var jqPage = $(this);
			if(! (jqPage.hasClass('active') || jqPage.hasClass('disabled'))) {
				var page = jqPage.data('page');
				settings.clickPage(page, jqPagination);
				
				if(settings.rebuildAfterClick) {
					//rebuild
					createPagination(jqPagination, settings);
					initPageClick(jqPagination, settings);
				}
			}
		});
	}
})(jQuery);