tinymce.PluginManager.add("link", function (e) {
	function t() {
		var t, n, r = e.dom,
			i = e.selection.getNode();
		var s, o, u;
		var a = "RESPONSIVE FileManager";
		if (typeof tinymce.settings.filemanager_title !== "undefined" && tinymce.settings.filemanager_title) {
			a = tinymce.settings.filemanager_title
		}
		t = e.windowManager.open({
			title: a,
			data: n,
			classes: "filemanager",
			file: tinyMCE.baseURL + "/plugins/filemanager/dialog.php?type=2&editor=" + e.id + "&lang=" + tinymce.settings.language,
			filetype: "file",
			width: 900,
			height: 600,
			inline: 1
		})
	}
	function n(t) {
		return function () {
			var n = e.settings.link_list;
			if (typeof n == "string") {
				tinymce.util.XHR.send({
					url: n,
					success: function (e) {
						t(tinymce.util.JSON.parse(e))
					}
				})
			} else {
				t(n)
			}
		}
	}
	function r(n) {
		function p(e) {
			var t = f.find("#text");
			if (!t.value() || e.lastControl && t.value() == e.lastControl.text()) {
				t.value(e.control.text())
			}
			f.find("#href").value(e.control.value())
		}
		function d() {
			var e = [{
				text: "None",
				value: ""
			}];
			tinymce.each(n, function (t) {
				e.push({
					text: t.text || t.title,
					value: t.value || t.url,
					menu: t.menu
				})
			});
			return e
		}
		function v(t) {
			var n = [{
				text: "None",
				value: ""
			}];
			tinymce.each(e.settings.rel_list, function (e) {
				n.push({
					text: e.text || e.title,
					value: e.value,
					selected: t === e.value
				})
			});
			return n
		}
		function m(t) {
			var n = [{
				text: "None",
				value: ""
			}];
			if (!e.settings.target_list) {
				n.push({
					text: "New window",
					value: "_blank"
				})
			}
			tinymce.each(e.settings.target_list, function (e) {
				n.push({
					text: e.text || e.title,
					value: e.value,
					selected: t === e.value
				})
			});
			return n
		}
		function g(t) {
			var n = [];
			tinymce.each(e.dom.select("a:not([href])"), function (e) {
				var r = e.name || e.id;
				if (r) {
					n.push({
						text: r,
						value: "#" + r,
						selected: t.indexOf("#" + r) != -1
					})
				}
			});
			if (n.length) {
				n.unshift({
					text: "None",
					value: ""
				});
				return {
					name: "anchor",
					type: "listbox",
					label: "Anchors",
					values: n,
					onselect: p
				}
			}
		}
		function y() {
			if (!a && r.text.length === 0) {
				this.parent().parent().find("#text")[0].value(this.value())
			}
		}
		var r = {},
			i = e.selection,
			s = e.dom,
			o, u, a;
		var f, l, c, h;
		o = i.getNode();
		u = s.getParent(o, "a[href]");
		r.text = a = u ? u.innerText || u.textContent : i.getContent({
			format: "text"
		});
		r.href = u ? s.getAttrib(u, "href") : "";
		r.target = u ? s.getAttrib(u, "target") : "";
		r.rel = u ? s.getAttrib(u, "rel") : "";
		if (o.nodeName == "IMG") {
			r.text = a = " "
		}
		if (n) {
			l = {
				type: "listbox",
				label: "Link list",
				values: d(),
				onselect: p
			}
		}
		if (e.settings.target_list !== false) {
			h = {
				name: "target",
				type: "listbox",
				label: "Target",
				values: m(r.target)
			}
		}
		if (e.settings.rel_list) {
			c = {
				name: "rel",
				type: "listbox",
				label: "Rel",
				values: v(r.rel)
			}
		}
		var b = e.id.replace("[", "").replace("]", "");
		f = e.windowManager.open({
			title: "Insert link",
			data: r,
			body: [{
				type: "container",
				layout: "flex",
				classes: "combobox has-open",
				label: "Source",
				direction: "row",
				align: 0,
				items: [{
					name: "href",
					type: "textbox",
					filetype: "file",
					size: 35,
					classes: "link_" + b,
					autofocus: true,
					label: "Url",
					onchange: y,
					onkeyup: y
				},
				{
					name: "upl_img",
					type: "button",
					classes: "btn open",
					icon: "browse",
					onclick: t,
					tooltip: "Select file"
				}]
			},
			{
				name: "text",
				type: "textbox",
				classes: "text_" + b,
				size: 40,
				label: "Text to display",
				onchange: function () {
					r.text = this.value()
				}
			},
			g(r.href), l, c, h],
			onSubmit: function (t) {
				function o(t, n) {
					window.setTimeout(function () {
						e.windowManager.confirm(t, n)
					}, 0)
				}
				function f() {
					console.log(n.text);
					if (n.text != a) {
						if (u) {
							e.focus();
							u.innerHTML = n.text;
							s.setAttribs(u, {
								href: r,
								target: n.target ? n.target : null,
								rel: n.rel ? n.rel : null
							});
							i.select(u)
						} else {
							e.insertContent(s.createHTML("a", {
								href: r,
								target: n.target ? n.target : null,
								rel: n.rel ? n.rel : null
							}, n.text))
						}
					} else {
						e.execCommand("mceInsertLink", false, {
							href: r,
							target: n.target,
							rel: n.rel ? n.rel : null
						})
					}
				}
				var n = t.data,
					r = n.href;
				if (!r) {
					e.execCommand("unlink");
					return
				}
				if (r.indexOf("@") > 0 && r.indexOf("//") == -1 && r.indexOf("mailto:") == -1) {
					o("The URL you entered seems to be an email address. Do you want to add the required mailto: prefix?", function (e) {
						if (e) {
							r = "mailto:" + r
						}
						f()
					});
					return
				}
				if (/^\s*www\./i.test(r)) {
					o("The URL you entered seems to be an external link. Do you want to add the required http:// prefix?", function (e) {
						if (e) {
							r = "http://" + r
						}
						f()
					});
					return
				}
				f()
			}
		})
	}
	e.addButton("link", {
		icon: "link",
		tooltip: "Insert/edit link",
		shortcut: "Ctrl+K",
		onclick: n(r),
		stateSelector: "a[href]"
	});
	e.addButton("unlink", {
		icon: "unlink",
		tooltip: "Remove link",
		cmd: "unlink",
		stateSelector: "a[href]"
	});
	e.addShortcut("Ctrl+K", "", n(r));
	this.showDialog = r;
	e.addMenuItem("link", {
		icon: "link",
		text: "Insert link",
		shortcut: "Ctrl+K",
		onclick: n(r),
		stateSelector: "a[href]",
		context: "insert",
		prependToContext: true
	})
})