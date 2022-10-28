(function(g){var window=this;'use strict';var A6=function(a){g.W.call(this,{G:"div",L:"ytp-miniplayer-ui"});this.gg=!1;this.player=a;this.S(a,"minimized",this.pg);this.S(a,"onStateChange",this.dF)},B6=function(a){g.kN.call(this,a);
this.i=new A6(this.player);this.i.hide();g.YM(this.player,this.i.element,4);a.Fe()&&(this.load(),g.O(a.getRootNode(),"ytp-player-minimized",!0))};
g.w(A6,g.W);g.k=A6.prototype;
g.k.oD=function(){this.tooltip=new g.KQ(this.player,this);g.J(this,this.tooltip);g.YM(this.player,this.tooltip.element,4);this.tooltip.scale=.6;this.qc=new g.fO(this.player);g.J(this,this.qc);this.xg=new g.W({G:"div",L:"ytp-miniplayer-scrim"});g.J(this,this.xg);this.xg.Da(this.element);this.S(this.xg.element,"click",this.pz);var a=new g.W({G:"button",Ga:["ytp-miniplayer-close-button","ytp-button"],W:{"aria-label":"Tutup"},T:[g.iL()]});g.J(this,a);a.Da(this.xg.element);this.S(a.element,"click",this.Ci);
a=new g.V1(this.player,this);g.J(this,a);a.Da(this.xg.element);this.hp=new g.W({G:"div",L:"ytp-miniplayer-controls"});g.J(this,this.hp);this.hp.Da(this.xg.element);this.S(this.hp.element,"click",this.pz);var b=new g.W({G:"div",L:"ytp-miniplayer-button-container"});g.J(this,b);b.Da(this.hp.element);a=new g.W({G:"div",L:"ytp-miniplayer-play-button-container"});g.J(this,a);a.Da(this.hp.element);var c=new g.W({G:"div",L:"ytp-miniplayer-button-container"});g.J(this,c);c.Da(this.hp.element);this.zL=new g.FP(this.player,
this,!1);g.J(this,this.zL);this.zL.Da(b.element);b=new g.AP(this.player,this);g.J(this,b);b.Da(a.element);this.nextButton=new g.FP(this.player,this,!0);g.J(this,this.nextButton);this.nextButton.Da(c.element);this.Ag=new g.xQ(this.player,this);g.J(this,this.Ag);this.Ag.Da(this.xg.element);this.Mc=new g.LP(this.player,this);g.J(this,this.Mc);g.YM(this.player,this.Mc.element,4);this.bz=new g.W({G:"div",L:"ytp-miniplayer-buttons"});g.J(this,this.bz);g.YM(this.player,this.bz.element,4);a=new g.W({G:"button",
Ga:["ytp-miniplayer-close-button","ytp-button"],W:{"aria-label":"Tutup"},T:[g.iL()]});g.J(this,a);a.Da(this.bz.element);this.S(a.element,"click",this.Ci);a=new g.W({G:"button",Ga:["ytp-miniplayer-replay-button","ytp-button"],W:{"aria-label":"Tutup"},T:[g.nL()]});g.J(this,a);a.Da(this.bz.element);this.S(a.element,"click",this.nU);this.S(this.player,"presentingplayerstatechange",this.Kc);this.S(this.player,"appresize",this.xb);this.S(this.player,"fullscreentoggled",this.xb);this.xb()};
g.k.show=function(){this.zd=new g.zq(this.Up,null,this);this.zd.start();this.gg||(this.oD(),this.gg=!0);0!==this.player.getPlayerState()&&g.W.prototype.show.call(this);this.Mc.show();this.player.unloadModule("annotations_module")};
g.k.hide=function(){this.zd&&(this.zd.dispose(),this.zd=void 0);g.W.prototype.hide.call(this);this.player.Fe()||(this.gg&&this.Mc.hide(),this.player.loadModule("annotations_module"))};
g.k.xa=function(){this.zd&&(this.zd.dispose(),this.zd=void 0);g.W.prototype.xa.call(this)};
g.k.Ci=function(){this.player.stopVideo();this.player.Ma("onCloseMiniplayer")};
g.k.nU=function(){this.player.playVideo()};
g.k.pz=function(a){if(a.target===this.xg.element||a.target===this.hp.element)g.T(this.player.U().experiments,"kevlar_miniplayer_play_pause_on_scrim")?g.lK(this.player.vb())?this.player.pauseVideo():this.player.playVideo():this.player.Ma("onExpandMiniplayer")};
g.k.pg=function(){g.O(this.player.getRootNode(),"ytp-player-minimized",this.player.Fe())};
g.k.kd=function(){this.Mc.Ob();this.Ag.Ob()};
g.k.Up=function(){this.kd();this.zd&&this.zd.start()};
g.k.Kc=function(a){g.V(a.state,32)&&this.tooltip.hide()};
g.k.xb=function(){g.XP(this.Mc,0,this.player.eb().getPlayerSize().width,!1);g.MP(this.Mc)};
g.k.dF=function(a){this.player.Fe()&&(0===a?this.hide():this.show())};
g.k.hc=function(){return this.tooltip};
g.k.Oe=function(){return!1};
g.k.kf=function(){return!1};
g.k.wi=function(){return!1};
g.k.Xz=function(){};
g.k.Rm=function(){};
g.k.Ar=function(){};
g.k.qn=function(){return null};
g.k.ej=function(){return new g.Fl(0,0,0,0)};
g.k.handleGlobalKeyDown=function(){return!1};
g.k.handleGlobalKeyUp=function(){return!1};
g.k.cq=function(a,b,c,d,e){var f=0,h=d=0,l=g.am(a);if(b){c=g.Jq(b,"ytp-prev-button")||g.Jq(b,"ytp-next-button");var m=g.Jq(b,"ytp-play-button"),n=g.Jq(b,"ytp-miniplayer-expand-watch-page-button");c?f=h=12:m?(b=g.Zl(b,this.element),h=b.x,f=b.y-12):n&&(h=g.Jq(b,"ytp-miniplayer-button-top-left"),f=g.Zl(b,this.element),b=g.am(b),h?(h=8,f=f.y+40):(h=f.x-l.width+b.width,f=f.y-20))}else h=c-l.width/2,d=25+(e||0);b=this.player.eb().getPlayerSize().width;e=f+(e||0);l=g.Rf(h,0,b-l.width);e?(a.style.top=e+"px",
a.style.bottom=""):(a.style.top="",a.style.bottom=d+"px");a.style.left=l+"px"};
g.k.showControls=function(){};
g.k.Tk=function(){};
g.k.wk=function(){return!1};g.w(B6,g.kN);B6.prototype.create=function(){};
B6.prototype.Ji=function(){return!1};
B6.prototype.load=function(){this.player.hideControls();this.i.show()};
B6.prototype.unload=function(){this.player.showControls();this.i.hide()};g.vN.miniplayer=B6;})(_yt_player);
