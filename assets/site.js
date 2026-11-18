(function () {
  "use strict";
  var WA = "573009413721";
  function waLink(text) { return "https://wa.me/" + WA + "?text=" + encodeURIComponent(text); }
  function fmt(n) { return Math.round(n).toLocaleString("es-CO"); }

  // Cada página abre desde arriba (no recuerda el scroll de la visita anterior)
  try { if ("scrollRestoration" in history) history.scrollRestoration = "manual"; } catch (e) {}
  function toTop(smooth) { window.scrollTo({ top: 0, left: 0, behavior: smooth ? "smooth" : "auto" }); }
  if (!location.hash) {
    toTop(false);
    window.addEventListener("load", function () { toTop(false); });
    window.addEventListener("pageshow", function () { toTop(false); });
  }

  // Menú móvil
  var toggle = document.querySelector(".nav-toggle");
  var nav = document.getElementById("nav");
  if (toggle && nav) {
    toggle.addEventListener("click", function () {
      var open = nav.classList.toggle("open");
      toggle.setAttribute("aria-expanded", open ? "true" : "false");
    });
  }

  // Enlaces del encabezado: si es la misma página, sube al inicio; si es otra, carga desde arriba
  document.querySelectorAll(".site-header a[href]").forEach(function (a) {
    a.addEventListener("click", function (e) {
      var href = a.getAttribute("href");
      if (!href || /^https?:|^#/.test(href)) return;
      var target = href.split("#")[0];
      var here = location.pathname.split("/").pop() || "index.html";
      var same = target === here || ((target === "./" || target === "") && (here === "" || here === "index.html"));
      if (nav) { nav.classList.remove("open"); if (toggle) toggle.setAttribute("aria-expanded", "false"); }
      if (same) { e.preventDefault(); toTop(true); }
    });
  });

  // Sombra del encabezado al hacer scroll
  var header = document.querySelector(".site-header");
  if (header) {
    var onScroll = function () { header.classList.toggle("scrolled", window.scrollY > 8); };
    window.addEventListener("scroll", onScroll, { passive: true });
    onScroll();
  }

  // Enlaces genéricos de WhatsApp: data-wa="mensaje"
  document.querySelectorAll("[data-wa]").forEach(function (a) {
    a.href = waLink(a.getAttribute("data-wa") || "Hola Domiwebb, quiero más información.");
    a.target = "_blank"; a.rel = "noopener";
  });

  // Calculadora de horas
  var ledger = document.getElementById("ledger");
  if (ledger) {
    var people = document.getElementById("people");
    var hours = document.getElementById("hours");
    var outPeople = document.getElementById("outPeople");
    var outHours = document.getElementById("outHours");
    var month = document.getElementById("hMonth");
    var year = document.getElementById("hYear");
    var days = document.getElementById("hDays");
    var cta = document.getElementById("ledgerCta");
    function calc() {
      var p = +people.value, h = +hours.value;
      var week = p * h, m = week * 52 / 12, y = week * 52;
      outPeople.textContent = p + (p === 1 ? " persona" : " personas");
      outHours.textContent = h + " h";
      month.textContent = fmt(m) + " h";
      year.textContent = fmt(y) + " h";
      days.textContent = fmt(y / 8);
      if (cta) cta.href = waLink("Hola Domiwebb. En mi negocio " + p + (p === 1 ? " persona dedica" : " personas dedican") + " cerca de " + h + " horas a la semana a tareas manuales (unas " + fmt(y) + " horas al año). Quiero saber qué se puede automatizar.");
    }
    people.addEventListener("input", calc);
    hours.addEventListener("input", calc);
    calc();
  }

  // Diagnóstico rápido
  var quiz = document.getElementById("quiz");
  if (quiz) {
    var result = document.getElementById("quizResult");
    var list = document.getElementById("quizList");
    var send = document.getElementById("quizSend");
    var REC = {
      web: "Página web profesional con botón de WhatsApp y SEO para aparecer en Google.",
      auto: "Sistema a la medida: POS, inventario, facturación o respuestas automáticas por WhatsApp.",
      data: "Tablero de indicadores para ver ventas, gastos y operación en un solo lugar.",
      adm: "Consultoría administrativa: procesos, roles y rutinas para que el negocio no dependa de ti en todo.",
      cont: "Consultoría contable: control de ingresos, gastos y flujo de caja.",
      leg: "Consultoría legal: formalización, contratos y políticas de tratamiento de datos."
    };
    function update() {
      var picks = [];
      quiz.querySelectorAll("input:checked").forEach(function (i) { (i.getAttribute("data-rec") || "").split(" ").forEach(function (r) { if (r && picks.indexOf(r) < 0) picks.push(r); }); });
      var sector = quiz.querySelector('input[name="sector"]:checked');
      var pain = quiz.querySelector('input[name="pain"]:checked');
      var web = quiz.querySelector('input[name="web"]:checked');
      var ready = sector && pain && web;
      result.hidden = !ready;
      if (!ready) return;
      list.innerHTML = "";
      picks.slice(0, 3).forEach(function (k) { var li = document.createElement("li"); li.textContent = REC[k]; list.appendChild(li); });
      var txt = "Hola Domiwebb, hice el diagnóstico en su web.\nSector: " + sector.value + "\nMayor problema: " + pain.value + "\n¿Tiene página web?: " + web.value + "\nQuiero conversar sobre cómo optimizar mi negocio.";
      send.href = waLink(txt);
    }
    quiz.addEventListener("change", update);
    update();
  }

  // Formulario de contacto → WhatsApp
  var form = document.getElementById("contactForm");
  if (form) {
    form.addEventListener("submit", function (e) {
      e.preventDefault();
      var d = new FormData(form);
      var name = (d.get("nombre") || "").toString().trim();
      var biz = (d.get("negocio") || "").toString().trim();
      var svc = (d.get("servicio") || "").toString();
      var msg = (d.get("mensaje") || "").toString().trim();
      var status = document.getElementById("formStatus");
      if (!name || !msg) { status.textContent = "Escribe tu nombre y cuéntanos qué necesitas para continuar."; return; }
      var text = "Hola Domiwebb, soy " + name + (biz ? " de " + biz : "") + ".\nMe interesa: " + svc + "\n" + msg;
      var link = document.getElementById("formLink");
      link.href = waLink(text);
      link.hidden = false;
      status.textContent = "Listo. Abre WhatsApp con el botón para enviarnos tu mensaje.";
      try { window.open(link.href, "_blank", "noopener"); } catch (err) {}
    });
  }

  var y = document.getElementById("year");
  if (y) y.textContent = new Date().getFullYear();
})();
