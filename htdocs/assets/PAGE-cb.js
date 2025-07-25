var cb = {
  // (A) INIT - GET HTML ELEMENTS
  hLoad : null,  // loading
  hToast : null, // toast
  hModal : null, // popup dialog
  hSide : null, // sidebar
  hPages : [], // page sections
  init : () => {
    // (A1) LOADING SPINNER
    cb.hLoad = document.getElementById("cb-loading");

    // (A2) TOAST
    cb.hToast = {
      o : new bootstrap.Toast(document.getElementById("cb-toast"), { delay: 3500 }),
      i : document.getElementById("cb-toast-icon"),
      h : document.getElementById("cb-toast-head"),
      b : document.getElementById("cb-toast-body")
    };

    // (A3) MODAL
    cb.hModal = {
      o : new bootstrap.Modal(document.getElementById("cb-modal")),
      h : document.getElementById("cb-modal-head"),
      b : document.getElementById("cb-modal-body"),
      f : document.getElementById("cb-modal-foot")
    };

    // (A4) PAGES
    for (let i=1; i<=5; i++) {
      cb.hPages.push(document.getElementById("cb-page-"+i));
    }

    // (A5) SIDEBAR
    cb.hSide = document.getElementById("cb-side");
  },

  // (B) HTML INTERFACE
  // (B1) LOADING SPINNER
  //  show : boolean, show or hide loading spinner
  loading : show => {
    if (show) { cb.hLoad.classList.remove("cb-hide"); }
    else { cb.hLoad.classList.add("cb-hide"); }
  },

  // (B2) TOAST MESSAGE
  //  status : boolean, success or failure icon
  //  head : string, title text
  //  body : string, body text
  toast : (status, head, body) => {
    if (status==1 || status=="1" || status==true) { cb.hToast.i.className = "ico icon-checkmark"; }
    else if (status==0 || status=="0" || status==false) { cb.hToast.i.className = "ico icon-cross"; }
    else { cb.hToast.i.className = "ico icon-question"; }
    cb.hToast.h.innerHTML = head;
    cb.hToast.b.innerHTML = body;
    cb.hToast.o.show();
  },

  // (B3) MODAL DIALOG BOX
  //  head : string, title text
  //  body : string, body text
  //  foot : string, footer text
  //         function, auto generate yes/no buttons
  modal : (head, body, foot) => {
    cb.hModal.h.innerHTML = (head==null ? "" : head);
    cb.hModal.b.innerHTML = (body==null ? "" : body);
    if (foot==null) { cb.hModal.f.innerHTML = ""; }
    else if (typeof foot == "string") { cb.hModal.f.innerHTML = foot; }
    else {
      cb.hModal.f.innerHTML = 
      `<input type="button" class="btn btn-danger" value="No" data-bs-dismiss="modal">
       <input type="button" class="btn btn-primary" value="Yes" data-bs-dismiss="modal">`;
      cb.hModal.f.getElementsByClassName("btn-primary")[0].onclick = foot;
    }
    cb.hModal.o.show();
  },

  // (B4) CHANGE "LOCAL" PAGE
  //  num : int, page number (1 to 5)
  page : num => {
    num --;
    cb.transit(() => cb.pswitch(num));
  },
  pswitch : num => { for (let i in cb.hPages) {
    if (i==num) { cb.hPages[i].classList.remove("d-none"); }
    else { cb.hPages[i].classList.add("d-none"); }
  }},

  // (B5) TOGGLE SIDEBAR
  toggle : () => cb.hSide.classList.toggle("show"),

  // (C) AJAX CALL
  //  url : string, target URL
  //  data : optional object, data to send
  //  loading : boolean, show "now loading" screen? default true.
  //  noerr : boolean, supress modal "AJAX error message"? Default false.
  //  onpass : function, run this function on server response
  //  onerr : optional function, run this function on error
  ajax : opt => {
    // (C1) CHECKS & DEFAULTS
    if (opt.url === undefined) { cb.modal("AJAX ERROR", "Target URL is not set!"); return false; }
    if (opt.onpass === undefined) { cb.modal("AJAX ERROR", "Function to call on onpass is not set!"); return false; }
    if (opt.loading === undefined) { opt.loading = true; }
    if (opt.noerr === undefined) { opt.noerr = false; }

    // (C2) DATA TO SEND
    var data = new FormData();
    if (opt.data) { for (let [k,v] of Object.entries(opt.data)) { data.append(k, v); }}

    // (C3) AJAX REQUEST
    if (opt.loading) { cb.loading(true); }
    fetch(opt.url, { method:"POST", credentials:"include", body:data })
    .then(async res => {
      if (res.status==200) { return res.text(); }
      else {
        console.error(await res.text());
        if (!opt.noerr) { cb.modal("SERVER ERROR", "Bad server response - " + res.status); }
        if (opt.onerr) { opt.onerr(); }
        throw new Error("Bad server response");
      }
    })
    .then(txt => opt.onpass(txt))
    .catch(err => {
      console.error(err);
      if (!opt.noerr) { cb.modal("AJAX ERROR", err.message); }
      if (opt.onerr) { opt.onerr(); }
    })
    .finally(() => {
      if (opt.loading) { cb.loading(false); }
    });
  },

  // (D) AJAX API CALL
  //  mod : string, module to call
  //  act : string, action to perform
  //  data : object, data to send
  //  loading : boolean, show loading screen?
  //  noerr : boolean, supress modal "AJAX error message"? Default false.
  //  passmsg : boolean false to supress toast "success message".
  //            boolean true to use server response message.
  //            string to override "OK" message.
  //  nofail : boolean, supress modal "failure message"? Default false.
  //  onpass : optional function, run this on API response pass.
  //  onfail : optional function, run this on API response fail.
  //  onerr : optional function, run this on ajax call error.
  api : opt => {
    // (D1) INIT OPTIONS
    var options = {};
    options.url = `${cbhost.api}${opt.mod}/${opt.act}/`;
    if (opt.data) { options.data = opt.data; }
    if (opt.loading!=undefined) { options.loading = opt.loading; }
    if (opt.noerr!=undefined) { options.noerr = opt.noerr; }
    if (opt.passmsg === undefined) { opt.passmsg = "OK"; }
    if (opt.nofail === undefined) { opt.nofail = false; }
    if (opt.onerr) { options.onerr = opt.onerr; }

    // (D2) ON AJAX LOAD
    options.onpass = res => {
      // (D2-1) PARSE RESULTS
      try { var r = JSON.parse(res); }
      catch (err) {
        console.error(res);
        cb.modal("AJAX ERROR", "Failed to parse JSON data.");
        return false;
      }

      // (D2-2) RESULTS FEEBACK
      if (r.status=="E") { location.href = cbhost.base + "login/"; }
      else if (r.status) {
        if (opt.passmsg !== false) {
          cb.toast(1, "Success", opt.passmsg===true ? r.message : opt.passmsg);
        }
        if (opt.onpass) { opt.onpass(r); }
      } else {
        if (!opt.nofail) { cb.modal("ERROR", r.message); }
        if (opt.onfail) { opt.onfail(r.message); }
      }
    };

    // (D3) GO!
    cb.ajax(options);
  },

  // (E) AJAX LOAD HTML PAGE
  //  page : string, http://site.com/PAGE/
  //  target : string, ID of target HTML element
  //  data : object, data to send
  //  loading : boolean, show loading screen? Default false.
  //  noerr : boolean, supress modal "AJAX error message"? Default false.
  //  onload : optional function, do this on loaded
  //  onerr : optional function, do this on ajax error
  load : opt => {
    // (E1) INIT OPTIONS
    var options = {};
    options.url = `${cbhost.base}${opt.page}/`;
    if (opt.loading!=undefined) { options.loading = opt.loading; }
    if (opt.noerr!=undefined) { options.noerr = opt.noerr; }
    if (opt.onerr) { options.onerr = opt.onerr; }
    if (opt.data) {
      opt.data["ajax"] = 1;
      options.data = opt.data;
    } else { options.data = { "ajax" : 1 }; }

    // (E2) ON AJAX LOAD
    options.onpass = res => {
      if (res=="E") { location.href = cbhost.base + "login/"; }
      else {
        document.getElementById(opt.target).innerHTML = res;
        if (opt.onload) { opt.onload(); }
      }
    };

    // (E3) GO!
    cb.ajax(options);
  },

  // (F) SIGN OFF
  bye : () => cb.modal("Bestätigen", "Abmelden?", () => cb.api({
    mod : "session", act : "logout", passmsg : false,
    onpass : () => location.href = cbhost.base + "login/"
  })),

  // (G) PASSWORD/HASH STRENGTH CHECKER
  checker : hash => /^(?=.*[0-9])(?=.*[A-Z]).{8,20}$/i.test(hash),

  // (H) TRANSITION
  transit : swap => {
    if (document.startViewTransition) { document.startViewTransition(swap); }
    else { swap(); }
  }
};

// (H) INIT INTERFACE
window.addEventListener("load", cb.init);