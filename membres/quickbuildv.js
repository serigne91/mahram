/*** Freeware Open Source writen by ngoCanh 2002-05                  */
/*** Original by Vietdev  http://vietdev.sourceforge.net             */
/*** Release 2002-11-02  R11.0                                       */
/*** GPL - Copyright protected                                       */
/*********************************************************************/


/*** CONFIGURATION - HERE YOU CAN SET DEFAULT-VALUES ********************/
if(typeof(QBPATH)=="undefined") QBPATH='.'
if(typeof(SECURE)=="undefined") SECURE=1; //=0,1
if(typeof(VISUAL)=="undefined") VISUAL=1; //=0,1,2,3 see bottom of this file
if(typeof(POPWIN)=="undefined") POPWIN=1; //=1,0 Rightclick Popup dialog for textarea
if(typeof(DFFACE)=="undefined") DFFACE=''; // 'times new roman'; // Default fontFamily of Editor
if(typeof(DFSIZE)=="undefined") DFSIZE=''; // '14px'; // Default fontSize
if(typeof(DCOLOR)=="undefined") DCOLOR=''; // 'blue'; // Default color
if(typeof(DBGCOL)=="undefined") DBGCOL=''; // 'green'; // Default backgroundColor
if(typeof(DBGIMG)=="undefined") DBGIMG=''; // Default URL-backgroundImage 
if(typeof(DCSS)=="undefined") DCSS=''; // 'test.css'; // Default-Stylesheet-URL
if(typeof(SYMBOLE)=="undefined") SYMBOLE='<QBFBR>' ; // Symbole for end-of-field in clipboard-chipcard.
if(typeof(USETABLE)=="undefined") USETABLE=1; // Enable table editor
if(typeof(USEFORM)=="undefined") USEFORM=0; // Enable form input
if(typeof(RETURNNL)=="undefined") RETURNNL=1; // Return-Button= Newline; Shift+Return= New Paragraph
if(typeof(FULLCTRL)=="undefined") FULLCTRL=0; //=0,1; 0=fast loading; 1=all control rows at bottom of Edi.

if(typeof(ON_OFF)=="undefined") ON_OFF=1; // VietTyping 1:ON, 0:OFF
if(typeof(TYPMOD)=="undefined") TYPMOD=1; // VietTyping-mode 0:Auto, 1:Vni, 2:Telex, 3:VIQR
if(typeof(SPELL)=="undefined") SPELL=1; // Check vietnamese word  0:No-check, 1:Yes
if(typeof(POPSTATUS)=="undefined") POPSTATUS=1; // =0: Hint in Statusbar
/*********************** END CONFIGURATION ****************************/


var fID; //***   IFRAME ID
var TXTOBJ=null; //***   TEXT Obj
var format=new Array();
var viewm=new Array();
var FACE= new Array();
var SIZE= new Array();
var COLOR= new Array();
var BCOLOR= new Array();
var BIMAGE= new Array();
var CSS= new Array();
var FWORD, FLAGS=0;



document.onmousedown=doMDown
document.onmouseup= doMUp
document.onkeydown=doKDown



function changetoIframeEditor(el)
{
   if(navigator.platform!="Win32") return null;

   var wi= '', hi= '';
   if(el.style.height) hi= el.style.height
   else if(el.rows) hi= (14*el.rows+28)
   if(el.style.width) wi= el.style.width
   else if(el.cols) wi= (6*el.cols +25)
   	   
   var parent= el.parentElement
   while(parent.tagName != 'FORM') parent= parent.parentElement
   var oform= parent
   var fidx=0; while(document.forms[fidx] != oform) fidx++ ; // form index

   var val='', fID;


   if(el.tagName=='TEXTAREA' || el.tagName=='INPUT'){ fID= fidx+'VDevID'+el.name; val= el.innerText }
   else fID= fidx+'VDevID'+el.id

   var strx = createEditor(fID,wi,hi);
   el.outerHTML= strx
   
   iEditor(fID)

   if(el.tagName!='TEXTAREA' && el.tagName!='INPUT') return

   val= val.replace(/\r/g,"");
   val= val.replace(/\n</g,"<");
   
   var reg= /<pre>/i ;
   if( reg.test(val) )
	 { val= val.replace(/\n/g, "&#13;"); val= val.replace(/\t/g, "     "); }

   val= val.replace(/\n/g, "<br>");
   val= val.replace(/\t/g, "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;");

   val= val.replace(/\\/g, "&#92;");
   val= val.replace(/\'/g, "&#39;");

   if(val && val.indexOf('ViEtDeVdIvId')>=0) val= initDefaultOptions1(val,fID)
   else initDefaultOptions0(fID)

   setTimeout("document.frames['"+fID+"'].document.body.innerHTML='"+val+"'",200)

   oform[fID.split('VDevID')[1]].value= val

   TXTOBJ= null

   return true;
   
}




function doMDown()
{
  var el=event.srcElement 

  if(el.type=='text' || el.type=='textarea')
   {
	TXTOBJ=el; fID=''
    if(event.button==2 && POPWIN==1) formatDialog()
   }
}





function doFormat(arr,caret)
{
  var wrd=TXTOBJ.curword.text

  var cmd = new Array();
  cmd = arr.split(',')

  if(!cmd[0] || cmd[0]=='Swap[Text/HTML]' || cmd[0]=='Swap[Uni/View]' ) return 
  if(cmd[0]=='SelectAll') { TXTOBJ.focus(); TXTOBJ.select(); return }
  if(cmd[0]=='Cut') { caret.execCommand("Cut"); return }
  if(cmd[0]=='Copy') { caret.execCommand("Copy"); return }
  if(cmd[0]=='Paste') { caret.execCommand("Paste"); return }

  TXTOBJ.curword=caret.duplicate();
  TXTOBJ.curword.text= cmd[0]+wrd+cmd[1]
}






function FMDown()
{
  var el=document.frames[fID];
  var el = el.event.srcElement 
  if(USETABLE) doClick(el)
}




// init all found TEXTAREA in document
function changeAllTextareaToEditors()
{
  var i=0;
  while(document.all.tags('textarea')[i])
   { 
    if(!changetoIframeEditor(document.all.tags('textarea')[i])) break;
	if(++i>0 && !document.all.tags('textarea')[i] ) i=0;
   }
}



// init all found IFRAME in document to Editable
function changeAllIframeToEditors()
{
  var i=0;
  while(document.all.tags('iframe')[i])
  { 
	if(!changetoIframeEditor(document.all.tags('iframe')[i])) break;
	i++
  }

}



// init some IFRAMEs
// e.g. changeIframeToEditor('id1','id2',...); // id1= id of frame
function changeIframeToEditor()
{
  for(var j=0;j<arguments.length;j++)
   {
     var i=0;
	 while(document.all.tags('iframe')[i])
	  { 
		if(document.all.tags('iframe')[i].id == arguments[j])
		  {	changetoIframeEditor(document.all.tags('iframe')[i]); break; }
	    i++
	  }
   }
}




/////////////////////////////////////////////////////////////////
function controlRows(fid)
{
  var str = "\
<style>\
img.vdev {width:23; height:22}\
select.vdev {font-family:arial; font-size:12; height:22; background:#a0a080; color:#FFFFFF}\
input.vdev {font-family:arial; font-size:12; height:20; background:#a0a080; color:#FFFFFF}\
</style>\
<TR bgColor=#c0c0a0 align=center valign=middle EVENT>\
<TD nowrap style='cursor:hand'>\
<img src='IURL/bold.gif' alt='Bold' class=vdev onclick='doFormatF(\"Bold\")'>\
<img src='IURL/left.gif' alt='Left' class=vdev onclick='doFormatF(\"JustifyLeft\")'>\
<img src='IURL/center.gif' alt='Center' class=vdev onclick='doFormatF(\"JustifyCenter\")'>\
<img src='IURL/right.gif' alt='Right' class=vdev onclick='doFormatF(\"JustifyRight\")'>\
<img src='IURL/outdent.gif' alt='Outdent' class=vdev onclick='doFormatF(\"Outdent\")'>\
<img src='IURL/indent.gif' alt='Indent' class=vdev onclick='doFormatF(\"Indent\")'>\
<img src='IURL/italic.gif' alt='Italic' class=vdev onclick='doFormatF(\"Italic\")'>\
<img src='IURL/under.gif' alt='Underline' class=vdev onclick='doFormatF(\"Underline\")'>\
<img src='IURL/strike.gif' alt='StrikeThrough' class=vdev onclick='doFormatF(\"StrikeThrough\")'>\
<img src='IURL/superscript.gif' alt='SuperScript' class=vdev onclick='doFormatF(\"SuperScript\")'>\
<img src='IURL/subscript.gif' alt='SubScript' class=vdev onclick='doFormatF(\"SubScript\")'>\
<img src='IURL/bgcolor.gif' alt='Background' class=vdev onclick='selectBgColor()'>\
<img src='IURL/fgcolor.gif' alt='Foreground' class=vdev onclick='selectFgColor()'>\
<img src='IURL/image.gif' alt='Insert Image' class=vdev onclick='doFormatF(\"InsertImage\")'>\
<img src='IURL/link.gif' alt='Create Link' class=vdev onclick='doFormatF(\"CreateLink\")'>\
<img src='IURL/unlink.gif' alt='Del Link' class=vdev onclick='doFormatF(\"UnLink\")'>\
<img src='IURL/numlist.gif' alt='OrderedList' class=vdev onclick='doFormatF(\"InsertOrderedList\")'>\
<img src='IURL/bullist.gif' alt='UnorderedList' class=vdev onclick='doFormatF(\"InsertUnorderedList\")'>\
<img src='IURL/all.gif' alt='SelectAll' class=vdev onclick='selectAll()'>\
<img src='IURL/cut.gif' alt='Cut' class=vdev onclick='doFormatF(\"Cut\")'>\
<img src='IURL/copy.gif' alt='Copy' class=vdev onclick='doFormatF(\"Copy\")'>\
<img src='IURL/paste.gif' alt='Paste' class=vdev onclick='doFormatF(\"Paste\")'>\
<img src='IURL/chipcard.gif' alt='Content Recover/Insert-Smartcard-Data' class=vdev onclick='SmartcardData()'>\
</TD></TR>"

if(FULLCTRL)
{
str += "\
<TR bgColor=#c0c0a0 valign=middle align=center EVENT>\
<TD nowrap style='cursor:hand'>\
<img src='IURL/instable.gif' alt='InsertTable' class=vdev onclick='insertTable()'>\
<img src='IURL/tabprop.gif' alt='TableProperties' class=vdev onclick='tableProp()'>\
<img src='IURL/cellprop.gif' alt='CellProperties' class=vdev onclick='cellProp()'>\
<img src='IURL/inscell.gif' alt='InsertCell' class=vdev onclick='insertCell()'>\
<img src='IURL/delcell.gif' alt='DeleteCell' class=vdev onclick='deleteCell()'>\
<img src='IURL/insrow.gif' alt='InsertRow' class=vdev onclick='insertRow()'>\
<img src='IURL/delrow.gif' alt='DeleteRow' class=vdev onclick='deleteRow()'>\
<img src='IURL/inscol.gif' alt='InsertCol' class=vdev onclick='insertCol()'>\
<img src='IURL/delcol.gif' alt='DeleteCol' class=vdev onclick='deleteCol()'>\
<img src='IURL/mrgcell.gif' alt='IncreaseColSpan' class=vdev onclick='morecolSpan()'>\
<img src='IURL/spltcell.gif' alt='DecreaseColSpan' class=vdev onclick='lesscolSpan()'>\
<img src='IURL/mrgrow.gif' alt='IncreaseRowSpan' class=vdev onclick='morerowSpan()'>\
<img src='IURL/spltrow.gif' alt='DecreaseRowSpan' class=vdev onclick='lessrowSpan()'>\
<img src='IURL/div.gif' alt='CreateDiv/DivStyle' class=vdev onclick='insertDivLayer()'>\
<img src='IURL/divborder.gif' alt='DivBorder' class=vdev onclick='editDivBorder()'>\
<img src='IURL/divfilter.gif' alt='DivFilter' class=vdev onclick='editDivFilter()'>\
<img src='IURL/cool.gif' alt='Emotions' class=vdev onclick='selectEmoticon()'>\
<img src='IURL/wow.gif' alt='Characters' class=vdev onclick='characters()'>\
<img src='IURL/hr.gif' alt='HR' class=vdev onclick='doFormatF(\"InsertHorizontalRule\")'>\
<img src='IURL/pre.gif' alt='Pre-Block' class=vdev onclick='doFormatF(\"formatBlock,PRE\")'>\
<img src='IURL/unpre.gif' alt='Del Pre-Block' class=vdev onclick='doFormatF(\"formatBlock,P\")'>\
<img src='IURL/marquee.gif' alt='Marquee' class=vdev onclick='doFormatF(\"InsertMarquee\")'>\
<img src='IURL/delformat.gif' alt='Delete Format' class=vdev onclick='doFormatF(\"RemoveFormat\")'>\
<img src='IURL/undo.gif' alt='Undo' class=vdev onclick='alert(\"Please press Ctrl+Z\")'>\
<img src='IURL/redo.gif' alt='Redo' class=vdev onclick='alert(\"Please press Ctrl+Y\")'>\
<img src='IURL/search.gif' alt='Search/Replace' class=vdev onclick='findText()'>\
<img src='IURL/file.gif' alt='Open/Save File' class=vdev onclick='FileDialog()'>\
</TD></TR>\
";
}

str += "<TR bgColor=#a0a080 valign=middle align=center EVENT>\
<TD nowrap style='cursor:hand'>\
<SELECT name='QBCNTRL1' class=vdev onchange='doFormatF(\"FontName,\"+this.value)' style='width:120'>\
<OPTION value=''>Default Font\
<OPTION value='Arial'>Arial\
<OPTION value='Times New Roman'>Times New Roman\
<OPTION value='Webdings'>Webdings\
</SELECT>\
<SELECT name='QBCNTRL2' class=vdev onchange='doFormatF(\"formatBlock,\"+this.value)' style='width:50'>\
<OPTION value=''>Head\
<OPTION value='H1'>H1\
<OPTION value='H2'>H2\
<OPTION value='H3'>H3\
<OPTION value='H4'>H4\
<OPTION value='H5'>H5\
<OPTION value='H6'>H6\
<OPTION value='P'>Remove</OPTION>\
</SELECT>\
<SELECT name='QBCNTRL3' class=vdev onchange='doFormatF(\"FontSize,\"+this.value)' style='width:55'>\
<OPTION value=3>FSize\
<OPTION value=7>Size=7\
<OPTION value=6>Size=6\
<OPTION value=5>Size=5\
<OPTION value=4>Size=4\
<OPTION value=3>Size=3\
<OPTION value=2>Size=2\
<OPTION value=1>Size=1\
</OPTION>\
</SELECT>"


if(USEFORM==1)
{
str += "\
<SELECT name='QBCNTRL4' class=vdev onchange=doFormatF(this.value) style='width:80'>\
<OPTION value=''>Form\
<OPTION value=InsertFieldset>Fieldset\
<OPTION value=InsertInputButton>Button\
<OPTION value=InsertInputReset>Reset\
<OPTION value=InsertInputSubmit>Submit\
<OPTION value=InsertInputCheckbox>Checkbox\
<OPTION value=InsertInputRadio>Radio\
<OPTION value=InsertInputText>Text\
<OPTION value=InsertSelectDropdown>Dropdown\
<OPTION value=InsertSelectListbox>Listbox\
<OPTION value=InsertTextArea>TextArea\
<OPTION value=InsertButton>IEButton\
<OPTION value=InsertIFrame>IFrame\
</SELECT>";
}

str += "\
<INPUT name='QBCNTRL6' value='qSave' class=vdev onclick='saveBefore()' type=button style='width:45'>\
<INPUT name='QBCNTRL5' value='SwapMode' class=vdev onclick='swapMode()' type=button style='width:70'>\
"

if(FULLCTRL)
{
str += "\
<INPUT name='QBCNTRL7' value='SwapCode' class=vdev onclick='swapView()' type=button style='width:70'>\
<INPUT name='QBCNTRL8' value='Upload' class=vdev onclick='doUploadFile()' type=button style='width:50'>\
<INPUT name='QBCNTRL9' value='Options' class=vdev onclick='doEditorOptions()' type=button style='width:50'>\
<INPUT name='QBCNTRL10' value='Help' class=vdev onclick='displayHelp()' type=button style='width:35'>\
";
}
else
{
str += "<INPUT name='QBCNTRL7' value='Extras' class=vdev onclick='doExtras()' type=button style='width:65; color:#00FF00'>"
}

str += "</TD></TR>"

 var iurl= QBPATH + '/imgedit'
 var event= "onmousedown='fID=\"" + fid +"\"'"
 str = str.replace(/IURL/g, iurl);
 str = str.replace(/EVENT/g, event);
 return str ;
}



function createEditor(id,wi,hi)
{
  if(parseInt(wi)<630) wi=630;

  var strx = "<iframe id="+id+" style='height:"+hi+"; width:"+wi+"'></iframe>"
  var idA= id.split('VDevID')
  strx += "<input name="+idA[1]+" type=hidden></input>"
  var str="<TABLE border=1 cellspacing=0 cellpadding=1 width="+wi+"><tr><td align=center>"
  str += strx+"</td></tr>"
  str += controlRows(id);
  str += "</TABLE>" ;
  return str ;
}




function doFormatF(arr)
{
  var el=document.frames[fID];
  if(!el){alert('Please click to select the editor');return}
  el.focus()

  var cmd = new Array();
  cmd = arr.split(',')

  if(cmd[0]=='SelectAll') selectAll();
  else if(cmd[0]=='Swap[Text/HTML]') swapMode(); 
  else if(cmd[0]=='Swap[Uni/View]') swapView();
  else if(cmd[0]=='InsertTable') insertTable();
  else if(cmd[0]=='TablePropeties') tableProp();
  else if(cmd[0]=='CellPropeties') cellProp();
  else if(cmd[0]=='InsertLayer') insertDivLayer();
  else if(cmd[0]=='EditLayerBorder') editDivBorder();
  else if(cmd[0]=='EditLayerFilter') editDivFilter();
  else if(cmd[0]=='Emotions') editEmotions(cmd[1],el);
  else if(cmd[0]=='InsertLayer') insertDivLayer();
  else
	{
	  var edit=el.document; 
	  if(cmd[0]=='formatBlock')
	   {
		 edit.execCommand(cmd[0],false,"<"+cmd[1]+">");
		 if(cmd[1]=='PRE' && format[fID]=="HTML") swapMode();
	   }
	  else if(cmd[0]=='InsertImage' && !cmd[1] )
	   { alert('Please notice:\nThe "Picture Source" in following Dialog must be a URL, not a local address.'); 
	     edit.execCommand(cmd[0],true,"") }
	  else if(cmd[1]!=null) edit.execCommand(cmd[0],false,cmd[1]) 
	  else edit.execCommand(cmd[0],false)
	}

}



function editEmotions(wrd,obj)
{
  var caret=obj.document.selection.createRange();
  obj.curword=caret.duplicate();
  obj.curword.text= wrd + ' '
}



function swapView()
{
 var el=document.frames[fID];
 if(!el){alert('Please click to select the editor');return}
 el.focus()

 var eStyle= el.document.body.style;
 var strx;
 if(format[fID]=="HTML")
 {
  FACE[fID]= eStyle.fontFamily
  SIZE[fID]= eStyle.fontSize
  COLOR[fID]= eStyle.color
  BCOLOR[fID]= eStyle.backgroundColor
  BIMAGE[fID]= eStyle.backgroundImage
  BIMAGE[fID]= BIMAGE[fID].substring( BIMAGE[fID].indexOf('(')+1,BIMAGE[fID].indexOf(')') )

  eStyle.fontFamily="";
  eStyle.fontSize="12pt"
  eStyle.fontStyle="normal"
  eStyle.color="black"
  eStyle.backgroundColor="#e0e0f0"
  eStyle.backgroundImage=''
  strx=el.document.body.innerHTML
  format[fID]="Text"
 }
 else
 {
  strx=el.document.body.innerText
 }


 if(viewm[fID]) strx=toUnicode(strx)
 else strx=viewISOCode(strx)

 el.document.body.innerText=strx
 viewm[fID]=1 - viewm[fID]

}



function swapMode()
{
 var el=document.frames[fID];
 if(!el){alert('Please click to select the editor');return}
 el.focus()

 var MARK= "ViEtDeVtRiCk"
 var selType=el.document.selection.type

 if(selType!="Control")
 {
   var caret=el.document.selection.createRange();
   el.curword=caret.duplicate();
   var selwrd= el.curword.text
   el.curword.text = selwrd + MARK;
 }

 var eStyle= el.document.body.style
	 
 if(format[fID]=="HTML")
 {
  FACE[fID]= eStyle.fontFamily
  SIZE[fID]= eStyle.fontSize
  COLOR[fID]= eStyle.color
  BCOLOR[fID]= eStyle.backgroundColor
  BIMAGE[fID]= eStyle.backgroundImage
  BIMAGE[fID]= BIMAGE[fID].substring( BIMAGE[fID].indexOf('(')+1,BIMAGE[fID].indexOf(')') )

  eStyle.fontFamily="";
  eStyle.fontSize="12pt"
  eStyle.fontStyle="normal"
  eStyle.color="black"
  eStyle.backgroundColor="#e0e0f0"
  eStyle.backgroundImage=''
  el.document.body.innerText= el.document.body.innerHTML
  format[fID]="Text"
 }
 else
 {
  eStyle.fontFamily= FACE[fID]
  eStyle.fontSize= SIZE[fID]
  eStyle.color= COLOR[fID]
  eStyle.backgroundColor= BCOLOR[fID]
  eStyle.backgroundImage= "url(" + BIMAGE[fID] + ")"

  el.document.body.innerHTML= el.document.body.innerText
  format[fID]="HTML"
  viewm[fID]=1
 }


 if(selType!="Control")
 {
  caret = el.document.selection.createRange();
  var found= caret.findText(MARK,100000,5) // backward
  if(found==false) 
   found= caret.findText(MARK,100000,4) // foreward

  if(found==false && format[fID]=="HTML") 
   {
     var strx= el.document.body.innerHTML
	 strx= strx.replace(/ViEtDeVtRiCk/ig,"");
	 el.document.body.innerHTML= strx
	 return;
   }

  caret.select();
  el.curword=caret.duplicate();
  el.curword.text = '' ;  // erase trick selection 

  if(selwrd!="") caret.findText(selwrd,100000,5); // real selection
  caret.select();  caret.scrollIntoView(); 
 }

}



function selectAll()
{ 
  var el=document.frames[fID];
  if(!el){alert('Please click to select the editor');return}
  el.focus()
  var s=el.document.body.createTextRange()
  s.execCommand('SelectAll')
}




function doFormatDialog(file,cmd,arg)
{ 
  var urlx= QBPATH + '/' + file

  var el=document.frames[fID];
  if(!el){alert('Please click to select the editor');return}

  var arr=showModalDialog(urlx, arg, "font-family:Verdana;font-size:12;dialogWidth:30em;dialogHeight:30em; edge:sunken;help:no;status:no");
  if(arr !=null) doFormatF(cmd+','+arr)
}


function selectEmoticon()
{ 
  var el=document.frames[fID];
  if(!el){alert('Please click to select the editor');return}
  el.focus();
  doFormatDialog('emoticon.html','InsertImage',QBPATH)
}

function selectBgColor()
{ 
  doFormatDialog('selcolor.html','BackColor','')
}


function selectFgColor()
{ 
  doFormatDialog('selcolor.html','ForeColor','')
}


function characters()
{
  var el=document.frames[fID];
  if(!el){alert('Please click to select the editor');return}
  el.focus();

  var sel = el.document.selection;
  if(sel.type=="Control") return 

  var urlx= QBPATH + '/selchar.html'
  var arr=showModalDialog(urlx, '', "font-family:Verdana;font-size:12;dialogWidth:30em;dialogHeight:34em; edge:sunken;help:no;status:no");
  if(arr==null) return

  var arrA = arr.split(';QuIcKbUiLd;')

  var strx= "<FONT FACE='" + arrA[0] + "'>" + arrA[1] + "</FONT>"

  var Range = sel.createRange();
  if(!Range.duplicate) return;
  Range.pasteHTML(strx);

}




function doUploadFile()
{
  var el=document.frames[fID];
  if(!el){alert('Please click to select the editor');return}
  el.focus()

  var urlx= QBPATH + '/upload.html'
  var twidth= 0.8*screen.width, theight=190;
  var tposx= (screen.width- twidth)/2
  var tposy= screen.height- theight - 55
  	    	  
  var newWin1=window.open(urlx,"upload","toolbar=no,width="+ twidth+",height="+ theight+ ",directories=no,status=no,scrollbars=yes,resizable=no, menubar=no")
  newWin1.moveTo(tposx,tposy);
  newWin1.focus()

}


function doEditorOptions()
{
  var el=document.frames[fID];
  if(!el){alert('Please click to select the editor');return}
  el.focus()

  var urlx= QBPATH + '/options.html'
  var twidth= 0.8*screen.width, theight=190;
  var tposx= (screen.width- twidth)/2
  var tposy= screen.height- theight - 55
  	    	  
  var newWin1=window.open(urlx,"options","toolbar=no,width="+ twidth+",height="+ theight+ ",directories=no,status=no,scrollbars=yes,resizable=no, menubar=no")
  newWin1.moveTo(tposx,tposy);
  newWin1.focus()

}


function displayHelp()
{
  var urlx= './edithelp.html'
  var newWin=window.open(urlx,"help","toolbar=no, width=600px,height=400px,directories=no,status=no,scrollbars=yes,resizable=yes,menubar=no;scroll=no")
  newWin.focus()
}


function doExtras()
{
  var el=document.frames[fID];
  if(!el){alert('Please click to select the editor');return}
  el.focus()

  var urlx= QBPATH + '/extras.html'
  var twidth=400, theight=20;
  var tposx= (screen.width- twidth)/2
  var tposy= screen.height- theight - 155
  	    	  
  var newWin1=window.open(urlx,"extras","toolbar=no,width="+ twidth+",height="+ theight+ ",directories=no,status=no,scrollbars=yes,resizable=no, menubar=no")
  newWin1.moveTo(tposx,tposy);
  newWin1.focus()

}



function insertLink(linkurl)
{
  var el=document.frames[fID];
  if(!el && !TXTOBJ){alert('Please click a text element');return}

  if(el)
  {
	el.focus();
    var sel = el.document.selection;
	var strx= "<A href='"+linkurl+"' target=nwin>" + linkurl + "</A>"

	var Range = sel.createRange();
	if(!Range.duplicate) return;
	Range.pasteHTML(strx);
  }
  else 
  {
	TXTOBJ.focus();
    var caret= TXTOBJ.document.selection.createRange()
	TXTOBJ.curword=caret.duplicate();
	var strx= "<A href='"+linkurl+"' target=nwin>" + linkurl + "</A>,"
	doFormat(strx,caret)
  }

}




function insertDivLayer()
{
  var el=document.frames[fID];
  if(!el){alert('Please click to select the editor');return}
  el.focus()
  
  var sel = el.document.selection;
  if(sel==null) return

  var Range = sel.createRange();
  var wrd='' ;

  if(sel.type!="Control")
  {
  	if(!Range.duplicate) return;
  	el.curword=Range.duplicate();
  	wrd= el.curword.text;
	if(wrd=='') wrd="I'm a DIV-Layer. Select me and click the button once more to change properties. Or doubleclick me to change the text."
	var arr= "<DIV style='position:relative; width:150px; height:100px; font-family:Arial; font-size:12px; background-color:#f0fdd0; border:1 solid'>"+ wrd + "</DIV>" ;
	Range.pasteHTML(arr);
	return
  }  

  if(Range(0).tagName!='DIV') return

  var urlx= QBPATH + '/divstyle.html'

  var twidth= 0.8*screen.width, theight=190;
  var tposx= (screen.width- twidth)/2
  var tposy= screen.height- theight - 55
  	    	  
  var newWin1=window.open(urlx,"divstyle","toolbar=no,width="+ twidth+",height="+ theight+ ",directories=no,status=no,scrollbars=yes,resizable=no, menubar=no")
  newWin1.moveTo(tposx,tposy);
  newWin1.focus()

}





function editDivBorder()
{
  var el=document.frames[fID];
  if(!el){alert('Please click to select the editor');return}
  el.focus()
  
  var sel = el.document.selection;
  if(sel==null || sel.type!='Control') {alert('Please click once to select a div-layer');return} 

  var Range = sel.createRange();
  if(Range(0).tagName!='DIV') return

  var urlx= QBPATH + '/divborder.html'

  var twidth= 0.8*screen.width, theight=215;
  var tposx= (screen.width- twidth)/2
  var tposy= screen.height- theight - 55
  	    	  
  var newWin1=window.open(urlx,"divborder","toolbar=no,width="+ twidth+",height="+ theight+ ",directories=no,status=no,scrollbars=yes,resizable=no, menubar=no")
  newWin1.moveTo(tposx,tposy);
  newWin1.focus()

}




function editDivFilter()
{
  var el=document.frames[fID];
  if(!el){alert('Please click to select the editor');return}
  el.focus()

  var sel = el.document.selection;
  if(sel==null || sel.type!='Control') {alert('Please click once to select a div-layer');return} 

  var Range = sel.createRange();
  if(Range(0).tagName!='DIV') return

  var urlx= QBPATH + '/divfilter.html'

  var twidth= 0.8*screen.width, theight=210;
  var tposx= (screen.width- twidth)/2
  var tposy= screen.height- theight - 55
  	    	  
  var newWin1=window.open(urlx,"divfilter","toolbar=no,width="+ twidth+",height="+ theight+ ",directories=no,status=no,scrollbars=yes,resizable=no, menubar=no")
  newWin1.moveTo(tposx,tposy);
  newWin1.focus()

}





function findTextHotKey(forward)
{
  if(!fID && !TXTOBJ){alert('Please click to select the editor');return}
  if(fID) el= document.frames[fID]
  else el= TXTOBJ
  el.focus();

  var rng = el.document.selection.createRange();
  el.curword=rng.duplicate();

  if(!FWORD && !el.curword.text ){ alert('No find string definition'); return }
  else if(el.curword.text)FWORD= el.curword.text

  if(el.curword.text)
   {
     if(forward==1) rng.moveEnd("character", -1 );  
	 else rng.moveStart("character", 1);  
   }

  if(rng.findText(FWORD,100000,FLAGS+forward)==true)
   { rng.select();  rng.scrollIntoView(); return }

  alert("Finish")
  return

}




function highLight(key)
{
  function doDefFormat()
	{
     var el= document.frames[fID]
     el.focus();
	 var rng = el.document.selection.createRange();
     rng.moveEnd("character", 1);
	 rng.select();
	 el.curword=rng.duplicate();
	 if(el.curword.text=='') doFormatF('RemoveFormat'); 
	 else
	  {
	    rng.moveEnd("character", -1);
   	    rng.select();
		doFormatF('ForeColor,'); doFormatF('BackColor,'); 
	  }
    }

  switch(key)
	{  
	  case 48: doDefFormat(); break; // ctrl+0  no highlight
	  case 49: doFormatF('ForeColor,red'); break; // ctrl+1
	  case 50: doFormatF('ForeColor,green'); break; // ctrl+2
	  case 51: doFormatF('ForeColor,blue'); break; // ctrl+3
      case 52: doFormatF('ForeColor,#00AAFF'); break; // ctrl+4
      case 53: doFormatF('ForeColor,magenta'); break; // ctrl+5
	  case 54: doFormatF('BackColor,yellow'); doFormatF('ForeColor,black'); break; // ctrl+6
	  case 55: doFormatF('BackColor,cyan'); doFormatF('ForeColor,black'); break; // ctrl+7
	  case 56: doFormatF('BackColor,#00FF00'); doFormatF('ForeColor,black'); break; // ctrl+8
	  case 57: doFormatF('BackColor,#FF00AA'); doFormatF('ForeColor,white'); break; // ctrl+9
    }
}




function FileDialog()
{
  var urlx= QBPATH + '/filedialog.html'
  var twidth= 0.5*screen.width, theight=100;
  var tposx= (screen.width- twidth)/2
  var tposy= screen.height- theight - 55
  	    	  
  var newWin1=window.open(urlx,"fdialog","toolbar=no,width="+ twidth+",height="+ theight+ ",directories=no,status=no,scrollbars=yes,resizable=no, menubar=no")
  newWin1.moveTo(tposx,tposy);
  newWin1.focus()
}




function initDefaultOptions0(fID)
{
   setTimeout("document.frames['"+fID+"'].document.body.style.fontFamily='"+DFFACE+"'",200)
   setTimeout("document.frames['"+fID+"'].document.body.style.fontSize='"+DFSIZE+"'",200)
   setTimeout("document.frames['"+fID+"'].document.body.style.color='"+DCOLOR+"'",200)
   setTimeout("document.frames['"+fID+"'].document.body.style.backgroundColor='"+DBGCOL+"'",200)
   setTimeout("document.frames['"+fID+"'].document.body.style.backgroundImage='url("+DBGIMG+")'",200)
   setTimeout("CSS['"+fID+"']=document.frames['"+fID+"'].document.createStyleSheet('"+DCSS+"')",200)
   FACE[fID]= DFFACE;
   SIZE[fID]= DFSIZE;
   COLOR[fID]= DCOLOR;
   BCOLOR[fID]= DBGCOL;
   BIMAGE[fID]= DBGIMG;
}






function DefaultOptions(linex)
{
  var retArr= new Array('','','','','','','');
  var tempx, strx, objx, idx ;

  // DEFAULT DIV
  var idx= linex.indexOf('ViEtDeVdIvId')
  if(idx>=0) 
	{
	  strx= linex.substring(linex.indexOf('ViEtDeVdIvId style="')+20,linex.indexOf('">'))

      var atrA= strx.split("; ")
	  for(var i=0; i<atrA.length; i++)
		{
		  tempx= atrA[i].split(':')
		  switch(tempx[0])
		   {
			case "FONT-FAMILY": retArr[0]= tempx[1]; break;
			case "FONT-SIZE": retArr[1]= tempx[1]; break;
			case "BACKGROUND-COLOR": retArr[2]= tempx[1]; break;
			case "COLOR": retArr[3]= tempx[1]; break;
			case "BACKGROUND-IMAGE": if(tempx[2]) tempx[1] += ':'+ tempx[2];
									 retArr[4]= tempx[1].substring(tempx[1].indexOf('url(')+4,tempx[1].indexOf(')') ); 
									 break;
		   }
	    }
      linex= linex.substring(linex.indexOf('>')+1,linex.lastIndexOf('</DIV>'))
    }


   // EXT STYLE
   idx= linex.indexOf('<style>@import url("')
   if( idx>=0 )
    {
	   var strx= linex.substring(idx+20, linex.indexOf('")'))
       retArr[5]= strx
	   linex= linex.substring(0,idx)
    }

   retArr[6]= linex
	   
   return retArr

}





function initDefaultOptions1(linex,fID)
{
  var retArr= new Array();

  retArr= DefaultOptions(linex);

  setTimeout("document.frames['"+fID+"'].document.body.style.fontFamily='"+retArr[0]+"'",200)
  setTimeout("document.frames['"+fID+"'].document.body.style.fontSize='"+retArr[1]+"'",200)
  setTimeout("document.frames['"+fID+"'].document.body.style.backgroundColor='"+retArr[2]+"'",200)
  setTimeout("document.frames['"+fID+"'].document.body.style.color='"+retArr[3]+"'",200)
  setTimeout("document.frames['"+fID+"'].document.body.style.backgroundImage='url("+retArr[4]+")'",200)
  setTimeout("CSS['"+fID+"']=document.frames['"+fID+"'].document.createStyleSheet('"+retArr[5]+"')",200)
  FACE[fID]= retArr[0];
  SIZE[fID]= retArr[1];
  COLOR[fID]= retArr[3];
  BCOLOR[fID]= retArr[2];
  BIMAGE[fID]= retArr[4];

  return retArr[6]

}





function toUnicode(str1)
{
  var code, str2 , j=0;
  var len
  while(j<2)
   {
	len=str1.length
	str2=''
	for(var i=0;i<len;i++) 
	 {
      code=str1.charCodeAt(i);
      if(code<128) continue;
      str2 +=str1.substring(0,i) + '&#' + code + ';'
      str1=str1.substring(i+1,str1.length)
      len=str1.length
      i=0
     }
    str1=str2+str1
    j++;
   }
  return str1;
}


/**** From Html-Code to UNICODE *********/
function  viewISOCode(str1)
{
 var c0, str2='', strx='', idx;
 
 idx=str1.indexOf('&#')
 if(idx<0) return str1
 var i=0
 while (i<str1.length)
  {
    c0=str1.substring(i,i+2)
    i++
    if(c0 !='&#') continue
    strx  +=str1.substring(0,i-1)
    str1=str1.substring(i-1,str1.length)
    idx=str1.indexOf(';')
    if(idx <0) break;
    str2=str1.substring(2,idx)
    str2++;str2--
    str1=str1.substring(idx+1,str1.length)
    strx +=String.fromCharCode(str2)
    i=0
  }
 return strx+str1;
}





function actualize()
{
  var i=0;
  while(document.all.tags('iframe')[i])
  { 
	setHiddenValue(document.all.tags('iframe')[i].id) 
	i++
  }
}



function setHiddenValue(fid)
{ 
 if(!fid) return

 var strx= editorContents(fid)
 var idA= fid.split('VDevID')
 if(!idA[0]) return;

 var fobj= document.forms[idA[0]]
 if(!fobj) return;

 fobj[idA[1]].value= strx

}	



function editorContents(fid)
{
  var el=document.frames[fid]
  if(!el)return

  var strx, strx1;
  if(format[fid]=="HTML")
	{
	  strx=el.document.body.innerHTML
	  strx1=el.document.body.innerText
	}
  else
	{
	  strx=el.document.body.innerText
	  strx1=el.document.body.innerHTML
    }
  if(strx1=='' && strx.indexOf('<IMG')<0 && strx.indexOf('<HR')<0 ) return ''


  strx = strx.replace(/\r/g,""); 
  strx = strx.replace(/\n>/g,">"); 
  strx = strx.replace(/>\n/g,">"); 

  strx = strx.replace(/\\/g,"&#92;");
  strx = strx.replace(/\'/g,"&#39;")

  // Security
  if(SECURE==1)
	{
	  strx = strx.replace(/<meta/ig, "< meta"); 
	  strx = strx.replace(/&lt;meta/ig, "&lt; meta"); 

	  strx = strx.replace(/<script/ig, "< script"); 
	  strx = strx.replace(/&lt;script/ig, "&lt; script"); 
	  strx = strx.replace(/<\/script/ig, "< /script"); 
	  strx = strx.replace(/&lt;\/script/ig, "&lt; /script"); 

	  strx = strx.replace(/<iframe/ig, "< iframe"); 
	  strx = strx.replace(/&lt;iframe/ig, "&lt; iframe"); 
	  strx = strx.replace(/<\/iframe/ig, "< /iframe"); 
	  strx = strx.replace(/&lt;\/iframe/ig, "&lt; /iframe"); 

	  strx = strx.replace(/<object/ig, "< object"); 
	  strx = strx.replace(/&lt;object/ig, "&lt; object"); 
	  strx = strx.replace(/<\/object/ig, "< /object"); 
	  strx = strx.replace(/&lt;\/object/ig, "&lt; /object"); 

	  strx = strx.replace(/<applet/ig, "< applet"); 
	  strx = strx.replace(/&lt;applet/ig, "&lt; applet"); 
	  strx = strx.replace(/<\/applet/ig, "< /applet"); 
	  strx = strx.replace(/&lt;\/applet/ig, "&lt; /applet"); 

	  strx = strx.replace(/ on/ig, " o&shy;n"); 
	  strx = strx.replace(/script:/ig, "script&shy;:"); 
    }


  var idx= strx.indexOf('ViEtDeVdIvId')
  if( idx>=0 ) strx= strx.substring(strx.indexOf('>')+1,strx.lastIndexOf('</DIV>'))

  idx= strx.indexOf('<style>@import url(')
  if( idx>=0 ) strx= strx.substring(0,idx)
  if(CSS[fid] && CSS[fid].href) strx += '<style>@import url("'+CSS[fid].href+'");</style>';


  var defdiv="" ;
  if(FACE[fid]) defdiv += "; FONT-FAMILY:"+ FACE[fid] 
  if(SIZE[fid]) defdiv += "; FONT-SIZE:"+ SIZE[fid]
  if(COLOR[fid]) defdiv += "; COLOR:"+ COLOR[fid]
  if(BCOLOR[fid])defdiv += "; BACKGROUND-COLOR:"+ BCOLOR[fid]
  if(BIMAGE[fid])
	{
     BIMAGE[fid]= BIMAGE[fid].replace(/\\/g,"/"); 
	 defdiv += "; BACKGROUND-IMAGE:url("+ BIMAGE[fid]+")"
    }
  if(defdiv)
	{
	 defdiv = '<DIV id=ViEtDeVdIvId style="POSTION:Relative' + defdiv + '">'
	 strx = defdiv + strx + "</DIV>"
	}

  return strx
}







function formatDialog()
{
  TXTOBJ.focus();
  var caret=TXTOBJ.document.selection.createRange()
  TXTOBJ.curword=caret.duplicate();
  
  var y = screen.height -parseInt('27em')*14 - 30 
  var feature = "font-family:Arial;font-size:10pt;dialogWidth:30em;dialogHeight:27em;dialogTop:"+y
      feature+= ";edge:sunken;help:no;status:no"

  var dialog= QBPATH+'/dialog.html'
  var arr= showModalDialog(dialog, "", feature);
  if(arr==null) return ;

  if(arr=='VISUAL')changetoIframeEditor(TXTOBJ);
  else doFormat(arr,caret)
}



if(USETABLE) document.writeln('<script src="'+QBPATH+'/tabedit.js"></script>');
if(RETURNNL) document.writeln('<script src="'+QBPATH+'/returnnl.js"></script>');
document.writeln('<script src="'+QBPATH+'/recover.js"></script>');




// VISUAL=0 : Textarea to Editor after confirmation
// VISUAL=1 : all Textarea to Editor
// VISUAL=2 : change only specific textarea
// VISUAL=3 : all Iframe to Editor
// VISUAL=4 : some specific iframes 
// VISUAL=other : no Visual-Editor, only use Rightmouse-Control
switch(VISUAL)
{
  case 1: changeAllTextareaToEditors(); break;
  case 2: changetoIframeEditor(document.forms[xxx].yyy); break;
  case 3: changeAllIframeToEditors(); break;// please replace xxx=formIndex and yyy=textareaName
  case 4: changeIframeToEditor('contents1','contents'); break;//please replace contents.. = fid
}





/*************************************************************/
/********************* not the same *************************/
function doMUp()
{
 var el=event.srcElement 
 if(!el.type) return
 if(el.type!='text'&&el.type!='textarea'&&el.type!='password'&&el.type!='file')
  {
	if(!el.name || el.name.substring(0,7)!='QBCNTRL')
	 { 
	   actualize(); 
	   if(el.type != 'select-one' && el.type != 'select-multiple') el.focus(); 
	 }
    return
  }

 var visual=''
 if(typeof(ASKED)=="undefined" && el.type=='textarea' && VISUAL==0)
  { visual=confirm("Use Visual Mode ?"); if(!visual) ASKED=1; }
 	 
 if(visual) changetoIframeEditor(el);

 ENGLISH=0;  
 if(POPSTATUS==1) qbmenuActivate()
 else statusMessage()

}



THOAT=0;
function doKDown()
{
  var el=event.srcElement 
  if(el.type!='text' && el.type!='textarea') return
  if(event.altKey) return;

  TXTOBJ=el; fID='';

  var ctrl= event.ctrlKey
  var shft= event.shiftKey
  var  key= event.keyCode
  
       if(ctrl && key==71) { findText(); return false }  // ctrl+G search
  else if(ctrl && key==75){ findTextHotKey(0); return false } // ctrl+K  search forward
  else if(ctrl && key==74){ findTextHotKey(1); return false } // ctrl+J  search backward 
  else if(ctrl && key==83 && SYMBOLE!=''){ SmartcardData(); return false } // ctrl+S content rewrite

  keyDownInit(key)
  
  if(ON_OFF==0 || ENGLISH || TYPMOD==1 || TYPMOD==2) return;

  if(ctrl && key==190){viewVietX(el,key,1); return false} // .
  if(ctrl && key==220){viewVietX(el,key,1); return false} // ^
  if(ctrl && shft && key==221){viewVietX(el,key,3); return false}
  if(ctrl && key==221){viewVietX(el,key,1); return false}
  if(ctrl && shft && key==219){viewVietX(el,key,3); return false} // \?
  if(ctrl && key==219){viewVietX(el,key,1); return false} // \ß special 
  if(ctrl && shft && key==187){viewVietX(el,key,3); return false} // *
  if(ctrl && key==187){viewVietX(el,key,1); return false} // +
  if(ctrl && shft && key==191){viewVietX(el,key,3); return false} // \'
  if(ctrl && key==191){viewVietX(el,key,1); return false} // \#
  if(ctrl && key==189){viewVietX(el,key,1); return false} // - 
  
  if(!shft && key==220){key=6; viewVietX(el,key,0); return false;} // ^
  if(shft && key==221){ key=2; viewVietX(el,key,0); return false;} // ` 
  else if(key==221){ key=1; viewVietX(el,key,0); return false;}  // '

}




function iEditor(idF)
{
  var obj=document.frames[idF]
  obj.document.designMode="On"
  obj.document.onmousedown= function(){ TXTOBJ=null; fID=idF; FMDown();}
  obj.document.onmouseup= FMUp
  obj.document.onkeypress=FKPress
  obj.document.onkeydown=FKDown
  
  format[idF]='HTML'
  viewm[idF]=1;
}




function FKDown()
{
  var el=document.frames[fID];
  if(!el||!el.event){alert('Please click to select the editor');return}
  if(el.event.altKey) return;

  var key=el.event.keyCode
  var shft= el.event.shiftKey
  var ctrl= el.event.ctrlKey

  if(RETURNNL && !shft && key==13){ insertNewline(el); return false }
  else if(RETURNNL && key==13){ insertNewParagraph(el); return false }

  
       if(ctrl && key==71){ findText(); return false }  // ctrl+G search
  else if(ctrl && key==75){ findTextHotKey(0); return false } // ctrl+K  search forward
  else if(ctrl && key==74){ findTextHotKey(1); return false } // ctrl+J  search backward 
  else if(ctrl && key==83 && SYMBOLE!=''){ SmartcardData(); return false } // ctrl+S content rewrite
  else if(ctrl && key==84){ swapMode(); return false } // ctrl+T swapMode
  else if(ctrl && (key>=48 && key<=57)){ highLight(key); return false } // ctrl+1 Highlight

  keyDownInit(key)

  if(ON_OFF==0 || ENGLISH || TYPMOD==1 || TYPMOD==2) return;

  if(ctrl && key==190){viewVietX(el,key,1); return false} // .
  if(ctrl && key==220){viewVietX(el,key,1); return false} // ^
  if(ctrl && shft && key==221){viewVietX(el,key,3); return false}
  if(ctrl && key==221){viewVietX(el,key,1); return false}
  if(ctrl && shft && key==219){viewVietX(el,key,3); return false} // \?
  if(ctrl && key==219){viewVietX(el,key,1); return false} // \ß special 
  if(ctrl && shft && key==187){viewVietX(el,key,3); return false} // *
  if(ctrl && key==187){viewVietX(el,key,1); return false} // +
  if(ctrl && shft && key==191){viewVietX(el,key,3); return false} // \'
  if(ctrl && key==191){viewVietX(el,key,1); return false} // \#
  if(ctrl && key==189){viewVietX(el,key,1); return false} // - 
  
  if(!shft && key==220){key=6; viewVietX(el,key,0); return false;} // ^
  if(shft && key==221){ key=2; viewVietX(el,key,0); return false;} // ` 
  else if(key==221){ key=1; viewVietX(el,key,0); return false;}  // '

}




function findText()
{
  if(!fID && !TXTOBJ){alert('Please click to select the editor');return}
  if(fID) document.frames[fID].focus()
  else TXTOBJ.focus()

  var urlx= QBPATH + '/dfindtextv.html'
  var newWin=window.open(urlx,"find","toolbar=no, width=350px,height=220px,directories=no,status=no,scrollbars=yes,resizable=yes,menubar=no;scroll=no")
  newWin.moveTo(screen.width-500,50);
  newWin.focus()
}



/******************************************************************************/
/************************** Not In English Version ****************************/
document.onkeypress=doKPress

function doKPress()
{
  var el=event.srcElement 
  if(el.type=='text'||el.type=='textarea') keyPressInit(event.keyCode,el)

  if( CHANGE ){ CHANGE=0; return false ; }// abort
  else return true ;  // no abort
}



function keyPressInit(key,obj)
{
  if(ON_OFF==0 || ENGLISH) return;

  var chr= String.fromCharCode(key) ;
  var chr1= chr.toUpperCase() ;
  
  if(chr=='\\'){ THOAT=1; return }

  if(key==223){ chr='?'; chr1='?' } // outlaw chu+~ etzess 

  if("SFRXJDAEOWZ1234567890/\'?~.-\#(+*".indexOf(chr1)>=0) viewViet(obj,chr)
  else if(chr1==' ') correcturAccent(obj)
  THOAT=0;
}




function FKPress()
{
  var obj=document.frames[fID];
  if(!obj||!obj.event){alert('Please click to select the editor');return}
  keyPressInit(obj.event.keyCode,obj)

  if( CHANGE ){ CHANGE=0; return false ; }// abort
  else return true ;  // no abort
}



function FMUp()
{ 
  ENGLISH=0; 
  if(POPSTATUS==1) qbmenuActivate()
  else statusMessage()
}



var ENGLISH=0, CODE, CHANGE=0;
var hmenu;


function notWord(cc)
{
 return ("\ \r\n#,\\;.:-_()<>+-*/=?!\"§$%{}[]\'~|^°€ß²³\@\&´`0123456789".indexOf(cc)>=0);
}


function UNI(str1,key,codeA)
{
 var codeH=new Array();
 for(var i=0;i<codeA.length-1;i+=2) codeH[codeA[i]]=codeA[i+1];

 var lenX=str1.length
 var sX1, sX2, c1X, c2X, c3X, c4X, code, code1, first=1;
 var ACCENT= 'sfrxjSFRXJ12345/\'-?#~\.'.indexOf(key)>=0
 CODE=''
 for(var i=lenX;i>=0;i--)
  {
    sX1=str1.substring(0,i-1)
    sX2=str1.substring(i,lenX)
    c1X=str1.substring(i-1,i); code2=c1X.charCodeAt(0) ;
	c2X=str1.substring(i-2,i-1); code=c2X.charCodeAt(0) ;
	c3X=str1.substring(i-3,i-2); code1=c3X.charCodeAt(0) ;
	c4X=(c3X+c2X).toLowerCase() ;

	/**************** typing assistance *****************/
	if( !key&&(code1==432||code1==431)&&(code==417||code==416) ) // Z+0 and u'o' -> undo
	  {
		c3X= (code1==432) ? 'u':'U'; c2X= (code==417) ? 'o':'O' ; CODE=1;
		return sX1.substring(0,sX1.length-2)+c3X+c2X+c1X+sX2
	  }

    if(key&&'wW7+*('.indexOf(key)>=0)
	  {
		if(c4X=='uo') // uon
         {
          c3X= (c3X=='u') ? 432:431 ; c2X= (c2X=='o') ? 417:416; CODE=1;
		  return sX1.substring(0,sX1.length-2)+String.fromCharCode(c3X)+String.fromCharCode(c2X)+c1X+sX2
	     } 
   	    if('aA'.indexOf(c1X)>=0 && (i<lenX||c4X=='qu') ) {} // qua
		else if( c2X && 'oO'.indexOf(c2X)>=0 && 'uU'.indexOf(c1X)>=0) continue // ou by no' u'
		else if( c2X && 'uU'.indexOf(c2X)>=0 && 'uUaA'.indexOf(c1X)>=0) continue // uu, ua
		else if( c2X && 'aA'.indexOf(c2X)>=0 && 'uU'.indexOf(c1X)>=0) // au
		 {
		  c2X= (c2X=='a') ? 226:194; CODE=1; // a^ , A^
		  return sX1.substring(0,sX1.length-1)+String.fromCharCode(c2X)+c1X+sX2
		 }
	  }

         if( c4X=='gi' && c1X && 'aAuU'.indexOf(c1X)>=0 ) {}
	else if( c2X && c1X && 'oO'.indexOf(c2X)>=0 && 'oO'.indexOf(c1X)>=0 ) {}
	else if( c2X && c1X && 'iI'.indexOf(c2X)>=0 && 'aAuU'.indexOf(c1X)>=0 )continue // ia,iu
    else if( ('aAiIyY'.indexOf(c1X)>=0 && (i<lenX||c4X=='qu') ) || (c2X && 'iI'.indexOf(c2X)>=0) ){} // --qua, qui, quy , ia, i..
	else if( ACCENT && 'oO'.indexOf(c1X)>=0 && c2X && 'uU'.indexOf(c2X)>=0 ){} // uo and ACCENT
	else if( ACCENT && first && 'aAeEiIoOuUyY'.indexOf(c1X)>=0 
		     && !( ('aA'.indexOf(c1X)>=0||'eE'.indexOf(c1X)>=0) && i<lenX) 
		   ){ first=0; continue }
	/**************** end typing assistance *****************/

	CODE=codeH[c1X.charCodeAt(0)]
	if(CODE) break;
	if(!CODE && !first){ ACCENT=0; first=1; i=lenX+1; continue}
  }

 if(!CODE) return str1+key
 if(isNaN(CODE)){str1=sX1+CODE+sX2+key;ENGLISH=1}
 else str1=sX1+String.fromCharCode(CODE)+sX2;
 return str1;
}




function correcturAccent(obj)
{
  if(obj.document.selection.type=='Control') return;

  var caret=obj.document.selection.createRange();

  var caret2=caret.duplicate();
  var wrd="", i=0, chrx, len ;
  while(1)
  {
   caret2.moveStart("character", -1);  
   obj.curword=caret2.duplicate();
   len=obj.curword.text.length
   if(len==wrd.length) break;
   wrd=obj.curword.text
   chrx=wrd.substring(0,1);
   if(notWord(chrx))
    {
      if(chrx.charCodeAt(0)==13) wrd=wrd.substr(2);
      else wrd=wrd.substr(1);
      break;
    }
   i++;
  }
 

  var wrdA= wrd.split(''), key;
  var lenx= wrd.length
  if(lenx<4) return; 
  var chr1= wrdA[lenx-3].charCodeAt(0)
  var chr2= wrdA[lenx-2].charCodeAt(0)
  var chr0= wrdA[lenx-4].charCodeAt(0)
  var pos=3

  if( chr2!=97 && chr2!=65 && chr2!=101 && chr2!=69 ) // a,A,e,E
    { chr2=chr1; chr1=chr0 ; pos=4}

  if( chr2==97 || chr2==65 || chr2==101 || chr2==69 ) // a,A,e,E
	{
	  switch(chr1)
		{
		  case 243:case 242:case 7887:case 245:case 7885: wrdA[lenx-pos]='o'; break;
		  case 211:case 210:case 7886:case 213:case 7884: wrdA[lenx-pos]='O'; break;
		}
	  switch(chr1)
		{
		  case 243 : case 211 : key='s'; break;
		  case 242 : case 210 : key='f'; break;
		  case 7887: case 7886: key='r'; break;
		  case 245 : case 213 : key='x'; break;
		  case 7885: case 7884: key='j'; break;
		  default: return;
	    }

	  wrd= wrdA.join('')
	  var typ= TYPMOD
	  TYPMOD= 2
	  wrd=toViet(wrd,key);
	  wrd += ' ';
	  TYPMOD= typ
 
	  caret.moveStart("character", -i);  
	  obj.curword=caret.duplicate();
	  obj.curword.text=wrd;
    }
 

}




function searchSelectWord(obj)
{
  var caret=obj.document.selection.createRange();
  var caret2=caret.duplicate();
  var wrd="", i=0, chrx, len ;
  while(1)
  {
   caret2.moveStart("character", -1);  
   obj.curword=caret2.duplicate();
   len=obj.curword.text.length
   if(len==wrd.length) break;
   wrd=obj.curword.text
   chrx=wrd.substring(0,1);
   if(notWord(chrx))
    {
      if(chrx.charCodeAt(0)==13) wrd=wrd.substr(2);
      else wrd=wrd.substr(1);
      break;
    }
   i++;
  }

  var arr= new Array()
  arr[0]= i; arr[1]= wrd;
  return arr
}



function viewVietX(obj,key,xkey)
{
  if(obj.document.selection.type=='Control') return;

  var caret=obj.document.selection.createRange();

  var arr= searchSelectWord(obj);
  var i= arr[0];
  var wrd= arr[1];
  var kchr;

  switch(key)
	{
	  case 190: if(xkey==1) kchr= '.'; break;
	  case 220: if(xkey==1) kchr= '^'; break;
	  case 221: if(xkey==1) kchr= '\''; else kchr= '\`'; break;
	  case 219: if(xkey==1) kchr= '\?'; else kchr='?'; break; // special
	  case 191: if(xkey==1) kchr= '\#'; else kchr='\''; break;
	  case 187: if(xkey==1) kchr= '+'; else kchr= '*'; break;
	  case 189: if(xkey==1) kchr= '-'; break;

	  case 6: if(wrd=='') wrd='^'; else wrd= toVietX(wrd,key); CHANGE=0; kchr= ''; break;
	  case 2: if(wrd=='') wrd='`'; else wrd= toVietX(wrd,key); CHANGE=0; kchr= ''; break;
	  case 1: if(wrd=='') wrd='\''; else wrd= toVietX(wrd,key); CHANGE=0; kchr= ''; break;
    }

  wrd += kchr;

  if(THOAT) i=1;
  caret.moveStart("character", -i);  
  obj.curword=caret.duplicate();
  obj.curword.text=wrd;

  THOAT=0;
}



function viewViet(obj,key)
{
  if(obj.document.selection.type=='Control') return;

  var caret=obj.document.selection.createRange();

  var arr= searchSelectWord(obj);
  var i= arr[0];
  var wrd= arr[1];

  wrd=toViet(wrd,key);

  if(THOAT) i=1;
  caret.moveStart("character", -i);  
  obj.curword=caret.duplicate();
  obj.curword.text=wrd;
  THOAT=0;
}



/**************** U N I C O D E *************************/
function toViet(str1,key)
{
   if(ENGLISH || !str1) return str1;
   if(SPELL==1 && notviet(str1)) return str1 ;


   var c2= '' + key; // change to string
   var c3=c2.toUpperCase();


    //*** TELEX ***
   var sx=''
   if(TYPMOD==2 || TYPMOD==0)
	{
	     if(c3=='D') sx=UNIDD(str1,c2)
    else if(c3=='A') sx=UNIAA(str1,c2)
    else if(c3=='E') sx=UNIEE(str1,c2)
	else if(c3=='O') sx=UNIOO(str1,c2)
	else if(c3=='W') sx=UNIWW(str1,c2)
    else if(c3=='S') sx=UNISS(str1,c2)
	else if(c3=='F') sx=UNIFF(str1,c2)
	else if(c3=='R') sx=UNIRR(str1,c2)
	else if(c3=='X') sx=UNIXX(str1,c2)
	else if(c3=='J') sx=UNIJJ(str1,c2)
	}

    //*** VNI 
   if(TYPMOD==1 || TYPMOD==0)
	{
   	     if(c3=='9') sx=UNIDD(str1,c2)
	else if(c3=='6') 
	 {
	    sx=UNIAA(str1,c2);
	    if(!CODE) sx=UNIEE(str1,c2);
		if(!CODE) sx=UNIOO(str1,c2);
      }
    else if(c3=='1') sx=UNISS(str1,c2)
    else if(c3=='2') sx=UNIFF(str1,c2)
    else if(c3=='3') sx=UNIRR(str1,c2)
    else if(c3=='4') sx=UNIXX(str1,c2)
    else if(c3=='5') sx=UNIJJ(str1,c2)
	else if(c3=='7'||c3=='8') sx=UNIWW(str1,c2)
	}


   //*** VIQR
   if(TYPMOD==3 || TYPMOD==0)
	{
   	      if(c3=='D') sx=UNIDD(str1,c2)
	 else if(c3=='/' || c3=='\''){sx=UNISS(str1,c3); if(!CODE) sx= str1 + c3 }
	 else if(c3=='-' ){sx=UNIFF(str1,c3); if(!CODE) sx= str1 + c3 }
	 else if(c3=='?'){sx=UNIRR(str1,c3); if(!CODE) sx= str1 + c3 }
	 else if(c3=='\~' || c3=='\#'){sx=UNIXX(str1,c3); if(!CODE) sx= str1 + c3 }
	 else if(c3=='.'){sx=UNIJJ(str1,c3); if(!CODE) sx= str1 + c3 }
     else if(c3=='+'||c3=='*'||c3=='('){sx=UNIWW(str1,c3); if(!CODE) sx= str1 + c3 }
	}

	if(TYPMOD==0 && c3=='0') sx=UNI00(str1,c2)	
    else if(c3=='Z'|| c3=='0') sx=UNIZZ(str1,c2)

	if(sx!=''){ CHANGE=1;  str1=sx }

    return str1;
}



function toVietX(str1,key)
{
   if(ENGLISH || !str1) return str1;
   if(SPELL==1 && notviet(str1)) return str1 ;

   var c2= '' + key; // change to string
   var c3=c2;
   var sx='';

   //*** VIQR
   if(TYPMOD==3 || TYPMOD==0)
	{
     if(c3=='6') 
	 {
	    sx=UNIAA(str1,'6');
	    if(!CODE) sx=UNIEE(str1,'6');
		if(!CODE) sx=UNIOO(str1,'6');
		if(sx=='') sx= str1 + "^"
		if(sx.lastIndexOf('6')>=0) sx= sx.substring(0,sx.length-1) + '^'
     }
     else if(c3=='1')
	 {
	   sx=UNISS(str1,'1');
	   if(sx=='') sx= str1 + "'"
   	   if(sx.lastIndexOf('1')>=0) sx= sx.substring(0,sx.length-1) + "'"
	 }
     else if(c3=='2')
	 {
	   sx=UNIFF(str1,'2'); 
	   if(sx=='') sx= str1 + "`" 
   	   if(sx.lastIndexOf('2')>=0) sx= sx.substring(0,sx.length-1) + "`"
	 }
	}

	if(sx!=''){ CHANGE=1;  str1=sx }
    return str1;
}



function UNIDD(str1,key)
{
 var codeA=new Array(100,273,68,272,273,'d',272,'D');
 return UNI(str1,key,codeA)
}


function UNIAA(str1,key)
{
 var codeA=new Array(97,226,65,194,
                     259,226,7855,7845,7857,7847,7859,7849,7861,7851,7863,7853,
					 258,194,7854,7844,7856,7846,7858,7848,7860,7850,7862,7852,
	                 225,7845,224,7847,7843,7849,227,7851,7841,7853,
	                 193,7844,192,7846,7842,7848,195,7850,7840,7852,
	                 226,'a',7845,'a',7847,'a',7849,'a',7851,'a',7853,'a',
					 194,'A',7844,'A',7846,'A',7848,'A',7850,'A',7852,'A'
                    );
 return UNI(str1,key,codeA);
}


function UNIWW(str1,key)
{
 var codeA=new Array(97,259,65,258,111,417,79,416,117,432,85,431,
	                 226,259,7845,7855,7847,7857,7849,7859,7851,7861,7853,7863,
	                 194,258,7844,7854,7846,7856,7848,7858,7850,7860,7852,7862,
	                 244,417,7889,7899,7891,7901,7893,7903,7895,7905,7897,7907,
	                 212,416,7888,7898,7890,7900,7892,7902,7894,7904,7896,7906,
	                 225,7855,224,7857,7843,7859,227,7861,7841,7863,
	                 193,7854,192,7856,7842,7858,195,7860,7840,7862,
	                 250,7913,249,7915,7911,7917,361,7919,7909,7921,
	                 218,7912,217,7914,7910,7916,360,7918,7908,7920,
	                 243,7899,242,7901,7887,7903,245,7905,7885,7907,
	                 211,7898,210,7900,7886,7902,213,7904,7884,7906,
					 259,'a',7855,'a',7857,'a',7859,'a',7861,'a',7863,'a',
					 417,'o',7899,'o',7901,'o',7903,'o',7905,'o',7907,'o',
					 432,'u',7913,'u',7915,'u',7917,'u',7919,'u',7921,'u',
					 258,'A',7854,'A',7856,'A',7858,'A',7860,'A',7862,'A',
					 416,'O',7898,'O',7900,'O',7902,'O',7904,'O',7906,'O',
					 431,'U',7912,'U',7914,'U',7916,'U',7918,'U',7920,'U'
						 
                    );
 return UNI(str1,key,codeA)
}



function UNIEE(str1,key)
{
 var codeA=new Array(
        234,'e',7871,'e',7873,'e',7875,'e',7877,'e',7879,'e',202,'E',7870,'E',7872,'E',7874,'E',7876,'E',7878,'E',
        101,234,233,7871,232,7873,7867,7875,7869,7877,7865,7879,69,202, 201,7870,200,7872,7866,7874,7868,7876,7864,7878
      );
 return UNI(str1,key,codeA)
}




function UNIOO(str1,key) // chu~ o
{
 var codeA=new Array(111,244,79,212,
                     417,244,7899,7889,7901,7891,7903,7893,7905,7895,7907,7897,
	                 416,212,7898,7888,7900,7890,7902,7892,7904,7894,7906,7896,
	                 243,7889,242,7891,7887,7893,245,7895,7885,7897,
	                 211,7888,210,7890,7886,7892,213,7894,7884,7896,
	                 244,'o',7889,'o', 7891,'o', 7893,'o', 7895,'o', 7897,'o',
	                 212,'O',7888,'O', 7890,'O', 7892,'O', 7894,'O', 7896,'O'
                    );
 return UNI(str1,key,codeA)
}



function UNISS(str1,key)
{
 var codeA=new Array( 
	   225,'a',7845,'a',7855,'a',233,'e',7871,'e',237,'i',243,'o',7889,'o',7899,'o',250,'u',7913,'u',253,'y',
       193,'A',7844,'A',7854,'A',201,'E',7870,'E',205,'I',211,'O',7888,'O',7898,'O',218,'U',7912,'U',221,'Y'
      )
 str2= UNI(str1,key,codeA);
 if(CODE) return str2;

 var str1= eraseAccent(str1);
 var codeA=new Array( 
	                  65,193,97,225,258,7854,259,7855,194,7844,226,7845,69,201,101,233,
	                  202,7870,234,7871,73,205,105,237,79,211,111,243,212,7888,
	                  244,7889,416,7898,417,7899,85,218,117,250,431,7912,432,7913,89,221, 121,253
	                 );
  return UNI(str1,key,codeA);
}



function UNIFF(str1,key)
{
 var codeA=new Array(
	   224,'a',7847,'a',7857,'a',232,'e',7873,'e',236,'i',242,'o',7891,'o',7901,'o',249,'u',7915,'u',7923,'y',
	   192,'A',7846,'A',7856,'A',200,'E',7872,'E',204,'I',210,'O',7890,'O',7900,'O',217,'U',7914,'U',7922,'Y'
      )
 str2= UNI(str1,key,codeA);
 if(CODE) return str2;

 var str1= eraseAccent(str1);
 var codeA=new Array(
	   65,192,97,224,258,7856,259,7857,194,7846,226,7847,69,200,101,232,202,7872,234,7873,73,204,
	   105,236,79,210,111,242,212,7890,244,7891,416,7900,417,7901,85,217,117,249,431,7914,432,7915,
       89,7922,121,7923 
	   )
 return UNI(str1,key,codeA);

}



function UNIRR(str1,key)
{
 var codeA=new Array(
       7843,'a',7849,'a',7859,'a',7867,'e',7875,'e',7881,'i',7887,'o',7893,'o',7903,'o',7911,'u',7917,'u',7927,'y',
       7842,'A',7848,'A',7858,'A',7866,'E',7874,'E',7880,'I',7886,'O',7892,'O',7902,'O',7910,'U',7916,'U',7926,'Y'
      )
 str2= UNI(str1,key,codeA);
 if(CODE) return str2;

 var str1= eraseAccent(str1);
 var codeA=new Array(
       65,7842,97,7843,258,7858,259,7859,194,7848,226,7849,69,7866,101,7867,202,7874,234,7875,73,7880,105,7881,79,7886,
	   111,7887,212,7892,244,7893,416,7902,417,7903,85,7910,117,7911,431,7916,432,7917,89,7926,121,7927
    )
 return UNI(str1,key,codeA);
}



function UNIXX(str1,key)
{
 var codeA=new Array(
       227,'a',7851,'a',7861,'a',7869,'e',7877,'e',297,'i',245,'o',7895,'o',7905,'o',361,'u',7919,'u',7929,'y',
       195,'A',7850,'A',7860,'A',7868,'E',7876,'E',296,'I',213,'O',7894,'O',7904,'O',360,'U',7918,'U',7928,'Y'
      )
 str2= UNI(str1,key,codeA);
 if(CODE) return str2;

 var str1= eraseAccent(str1);
 codeA=new Array(
       65,195,97,227,258,7860,259,7861,194,7850,226,7851,69,7868,101,7869,202,7876,234,7877,73,296,105,297,79,213,
	   111,245,212,7894,244,7895,416,7904,417,7905,85,360,117,361,431,7918,432,7919,89,7928,121,7929
     )
  return UNI(str1,key,codeA);
}



function UNIJJ(str1,key)
{
 var codeA=new Array(
	   7841,'a',7853,'a',7863,'a',7865,'e',7879,'e',7883,'i',7885,'o',7897,'o',7907,'o',7909,'u',7921,'u',7925,'y',
       7840,'A',7852,'A',7862,'A',7864,'E',7878,'E',7882,'I',7884,'O',7896,'O',7906,'O',7908,'U',7920,'U',7924,'Y'
      )
 str2= UNI(str1,key,codeA);
 if(CODE) return str2;

 var str1= eraseAccent(str1);
 codeA=new Array(
	   65,7840,97,7841,258,7862,259,7863,194,7852,226,7853,69,7864,101,7865,202,7878,234,7879,73,7882,105,7883,79,7884,
	   111,7885,212,7896,244,7897,416,7906,417,7907,85,7908,117,7909,431,7920,432,7921,89,7924,121,7925              
      )
 return UNI(str1,key,codeA);
}



function UNIZZ(str1,key)
{
  var str2= eraseAccent(str1);

  if(str2!=str1){ CHANGE=1; return str2 }

  var codeA=new Array(
       273,'d',272,'D',226,'a',259,'a',194,'A',258,'A',
	   234,'e',202,'E',244,'o',417,'o',212,'O',416,'O',
	   432,'u',431,'U' );

  var str1=UNI(str1,'',codeA);
  ENGLISH=0;
  if(!CODE) return str1+key
  return str1;
}



function UNI00(str1,key) // so^' 0
{
 var codeA=new Array(
	  7845,225,7847,224,7849,7843,7851,227,7853,7841,
	  7844,193,7846,192,7848,7842,7850,195,7852,7840,
	  7855,225,7857,224,7859,7843,7861,227,7863,7841,
	  7854,193,7856,192,7858,7842,7860,195,7862,7840,
	  7889,243,7891,242,7893,7887,7895,245,7897,7885,
	  7888,211,7890,210,7892,7886,7894,213,7896,7884,
	  7899,243,7901,242,7903,7887,7905,245,7907,7885,
	  7898,211,7900,242,7902,7886,7904,213,7906,7884,
	  7871,233,7873,232,7875,7867,7877,7869,7879,7865,
	  7870,201,7872,200,7874,7866,7876,7868,7878,7864,
	  7913,250,7915,249,7917,7911,7919,361,7921,7909,
	  7912,218,7914,217,7916,7910,7918,360,7920,7908,
	  273,'d',272,'D',
	  226,'a',259,'a',234,'e',244,'o',417,'o',432,'u',
	  194,'A',258,'A',202,'E',212,'O',416,'O',431,'U',
      225,'a',224,'a',7843,'a',227,'a',7841,'a',193,'A',192,'A',7842,'A',195,'A',7840,'A',
      233,'e',232,'e',7867,'e',7869,'e',7865,'e',201,'E',200,'E',7866,'E',7868,'E',7864,'E',
	  237,'i',236,'i',7881,'i',297,'i',7883,'i',205,'I',204,'I',7880,'I',296,'I',7882,'I',
	  243,'o',242,'o',7887,'o',245,'o',7885,'o',211,'O',210,'O',7886,'O',213,'O',7884,'O',
	  250,'u',249,'u',7911,'u',361,'u',7909,'u',218,'U',217,'U',7910,'U',360,'U',7908,'U',
	  253,'y',7923,'y',7927,'y',7929,'y',7925,'y',221,'Y',7922,'Y',7926,'Y',7928,'Y',7924,'Y'
      )
  
  var str1=UNI(str1,'',codeA);
  ENGLISH=0;
  if(!CODE) return str1+key
  return str1;
}




var VIETVOCAL= new Array(
         97,225,224,7843,227,7841,      65,193,192,7842,195,7840,         //a
	     226,7845,7847,7849,7851,7853,  194,7844,7846,7848,7850,7852,    //a^
		 259,7855,7857,7859,7861,7863,  258,7854,7856,7858,7860,7862,    //a(
	     101,233,232,7867,7869,7865,    69,201,200,7866,7868,7864,        //e  
	     234,7871,7873,7875,7877,7879,  202,7870,7872,7874,7876,7878,    //e^
	     105,237,236,7881,297,7883,     73,205,204,7880,296,7882,         //i
	     111,243,242,7887,245,7885,     79,211,210,7886,213,7884,         //o
	     244,7889,7891,7893,7895,7897,  212,7888,7890,7892,7894,7896,    //o^
	     417,7899,7901,7903,7905,7907,  416,7898,7900,7902,7904,7906,    //o' 
	     117,250,249,7911,361,7909,     85,218,217,7910,360,7908,         //u
	     432,7913,7915,7917,7919,7921,  431,7912,7914,7916,7918,7920,    //u'
	     121,253,7923,7927,7929,7925,   89,221,7922,7926,7928,7924        //y 
	  );


function indexOfViet(code)
{
  for(var i=0; i<VIETVOCAL.length; i++)
	{ if(code==VIETVOCAL[i]) return i;  }
  return -1;
}



function eraseAccent(str1)
{
  var code, delta, idx; 
  var strA= str1.split('');
  for(var i=0; i<strA.length; i++)
	{
      code= strA[i].charCodeAt(0) ;
	  idx = indexOfViet(code);
	  if(idx>=0)
	   {
		 delta= idx % 6; 
		 strA[i] = String.fromCharCode(VIETVOCAL[idx-delta]);
	   }
    }

   str1= strA.join('');
   return str1;
}




function notviet(wrd)
{
  wrd= wrd.toLowerCase();

  // special , ngoai. le^.
  var yes= "giac|giam|gian|giao|giap|giat|giay|giua|giuo|"
  yes += "ngoam|quam"
  var reg= eval("/"+yes+"/") ;
  var res= reg.test(wrd) ;
  if(res) return ''


  var no= '' ;
  no +="f|j|w|z|"
  no +="aa|ab|ad|ae|ag|ah|ak|al|aq|ar|as|av|ax|"
  no +="aca|aco|acu|"
  no +="aia|aic|aie|aim|ain|aio|aip|ait|aiu|"
  no +="ama|ame|ami|amo|amu|amy|"
  no +="ana|ane|ani|ano|anu|any|"
  no +="aoa|aoc|aoe|aoi|aom|aon|aop|aot|aou|"
  no +="apa|ape|aph|api|apo|apu|"
  no +="ata|ate|ath|ati|ato|atr|atu|aty|"
  no +="aua|auc|aue|aui|aum|aun|auo|aup|aut|auu|auy|"
  no +="aya|aye|ayn|ayt|ayu|"

  no +="bb|bc|bd|bg|bh|bk|bl|bm|bn|bp|bq|br|bs|bt|bv|bx|by|"
  no +="bec|bem|bio|boa|boe|bom|bou|bue|buy|"

  no +="cb|cc|cd|ce|cg|ci|ck|cl|cm|cn|cp|cq|cr|cs|ct|cv|cx|cy|"
  no +="chy|coa|coe|cou|cue|cuy|"

  no +="db|dc|dg|dh|dk|dl|dm|dn|dp|dq|dr|ds|dt|dv|dx|dy|"
  no +="dio|doe|dou|duu|"
        
  no +="ea|eb|ed|ee|eg|eh|ei|ek|el|eq|er|es|ev|ex|ey|"
  no +="eca|eco|ecu|ema|eme|emi|emo|emu|emy|ena|ene|eni|eno|enu|eny|"
  no +="eoa|eoc|eoe|eoi|eom|eon|eop|eot|eou|epa|epe|eph|epi|epo|epu|"
  no +="eta|ete|eth|eti|eto|etr|etu|ety|eua|euc|eue|eui|eum|eun|euo|eup|eut|euu|euy|"

  no +="gb|gc|gd|gg|gk|gl|gm|gn|gp|gq|gr|gs|gt|gv|gx|gy|"
  no +="gec|geo|get|geu|gha|gho|ghu|ghy|gic|gip|git|"
  no +="goe|gou|gua|gue|gum|gup|guu|"

  no +="hb|hc|hd|hg|hh|hk|hl|hm|hn|hp|hq|hr|hs|ht|hv|hx|"
  no +="hio|hou|hya|hye|hyn|hyt|hyu|"

  no +="ib|id|ig|ih|ii|ik|il|iq|ir|is|iv|ix|iy|"
  no +="iac|iam|ian|iao|iap|iat|iay|"
  no +="ica|ico|icu|ima|ime|imi|imo|imu|imy|ina|ine|ing|ini|ino|inu|iny|ioa|ioe|iou|"
  no +="ipa|ipe|iph|ipi|ipo|ipu|ita|ite|ith|iti|ito|itr|itu|ity|iua|iue|iuo|iuu|iuy|"

  no +="kb|kc|kd|kg|kk|kl|km|kn|kp|kq|kr|ks|kt|kv|kx|khy|"
  no +="kac|kai|kam|kan|kao|kap|kat|kau|kay|"
  no +="kea|key|khy|kio|koa|koc|koe|koi|kom|kon|kop|kot|kou|"
  no +="kua|kuc|kue|kui|kum|kun|kuo|kup|kut|kuu|kuy|kya|kye|kyn|kyt|kyu|"

  no +="lb|lc|ld|lg|lh|lk|ll|lm|ln|lp|lq|lr|ls|lt|lv|lx|"
  no +="lio|lou|lue|lya|lye|lyn|lyt|lyu|"

  no +="mb|mc|md|mg|mh|mk|ml|mm|mn|mp|mq|mr|ms|mt|mv|mx|"
  no +="mio|mip|miu|moa|moe|mou|mue|mup|muy|mya|mye|myn|myt|myu|"

  no +="nb|nc|nd|nk|nl|nm|nn|np|nq|nr|ns|nt|nv|nx|"
  no +="ngi|nge|nhy|nim|nio|nip|noe|nue|nuy|nya|nye|nyn|nyt|nyu|"

  no +="ob|od|og|oh|ok|ol|oo|oq|or|os|ov|ox|oy|"
  no +="oam|oap|oeo|oao|oau|oca|och|oco|ocu|oec|oem|oep|oeu|"
  no +="oia|oic|oie|oim|oin|oio|oip|oit|oiu|oma|ome|omi|omo|omu|omy|"
  no +="ona|one|onh|oni|ono|onu|ony|opa|ope|oph|opi|opo|opu|"
  no +="ota|ote|oth|oti|oto|otr|otu|oty|oua|ouc|oue|oui|oum|oun|ouo|oup|out|ouu|ouy|"

  no +="pa|pb|pc|pd|pe|pg|pi|pk|pl|pm|pn|po|pp|pq|pr|ps|pt|pu|pv|px|py|phy|"

  no +="qa|qb|qc|qd|qe|qg|qh|qi|qk|ql|qm|qn|qo|qp|qq|qr|qs|qt|qv|qx|qy|"
  no +="quc|qum|qun|qup|qut|quu|"

  no +="rb|rc|rd|rg|rh|rk|rl|rm|rn|rp|rq|rr|rs|rt|rv|rx|ry|"
  no +="rec|rio|roa|roe|rou|rue|"

  no +="sb|sc|sd|sg|sh|sk|sl|sm|sn|sp|sq|sr|ss|st|sv|sx|"
  no +="sec|sia|sic|sin|sio|sip|sit|siu|soe|sop|sou|sue|sum|sup|sya|sye|syn|syt|syu|"

  no +="tb|tc|td|tg|tk|tl|tm|tn|tp|tq|ts|tt|tv|tx|"
  no +="thy|tio|tou|tya|tye|tyn|tyt|tyu|"

  no +="ub|ud|ug|uh|uk|ul|uq|ur|us|uv|ux|"
  no +="uam|uca|uch|uco|ucu|uec|uem|uep|ueu|"
  no +="uia|uic|uie|uim|uin|uio|uip|uma|ume|umi|umo|umu|umy|"
  no +="una|une|unh|uni|uno|unu|uny|uoa|uoe|upa|upe|uph|upi|upo|upu|"
  no +="uta|ute|uth|uti|uto|utr|utu|uty|uua|uuc|uue|uui|uum|uun|uuo|uup|uut|uuu|uuy|"

  no +="vb|vc|vd|vg|vh|vk|vl|vm|vn|vp|vq|vr|vs|vt|vv|vx|"
  no +="vec|vep|vic|vim|vio|vip|voa|voe|vou|vue|vum|vup|vuu|vuy|vya|vye|vyn|vyt|vyu|"
    
  no +="xb|xc|xd|xg|xh|xk|xl|xm|xn|xp|xq|xr|xs|xt|xv|xx|xy|"
  no +="xim|xio|xip|xou|xuu"

  no +="yb|yd|yg|yh|yi|yk|yl|ym|yo|yp|yq|yr|ys|yv|yx|yy|"
  no +="yac|yai|yam|yan|yao|yap|yat|yau|yay|yec|yem|yeo|yep|yna|yne|yng|yni|yno|ynu|yny|"
  no +="yta|yte|yth|yti|yto|ytr|ytu|yty|yua|yuc|yue|yui|yum|yun|yuo|yup|yut|yuu|yuy"

  reg= eval("/"+no+"/") ;
  res= reg.test(wrd) ;
  return res
}




/************* QUICKBUILD-MENU  **********************/
function actInit()
{
  if(!hmenu ) hmenu = new MoveLayTo('qbmenu')

  var WHeight=document.body.offsetHeight
  var WWidth =document.body.offsetWidth
  
  // Here you can customize the position of qbmenu *********************
  var wx = WWidth - parseInt(document.all['qbmenu'].style.width)/2 -25
  var wy = WHeight - parseInt(document.all['qbmenu'].style.height)/2 -35
  // or wx= 10 and wy=10 -> top+left 
  // or wx= 10 -> bottom+left
  // or wy= 10 -> top+right
  // End position customize ********************************************
  
  
  var wx1= wx-0.001, wy1= wy-0.001;

  setInterval("hmenu.moveLayTo(50,"+wx1+","+wy1+","+wx+","+wy+")",25)

}



function qbmenuActivate()
{
  // Here you can customize the appearance of qbmenu **********************
  var mwidth= 140, mheight= 125, mbgcolor='#c0f0f0'; // menu size and color
  var fsize= 11, fcolor= 'red', fface= 'arial'; // font size and color
  var talign= '' ; //text align -> left,center,right,justify
  var fstyle= '' ; //text style -> italic,normal
  var tdecor= '' ;  // text decoration -> underline,none
  var mpadding= 3 ; // space between border and contents
  var mbordercolor= 'red'
  var mborderwidth= 2
  var mborderstyle= 'outset' ; // borderstyle -> none,solid,dotted,dashed,double,
  	                           // groove,ridge,inset,outset
  // End customize **********************************************************
  	  
  var str, mnuobj;
  if(!document.all['qbmenu'])
  {
   str = '<DIV id=qbmenu style="position:absolute; left:-1000px; top:0px"></DIV>'
   document.body.insertAdjacentHTML("BeforeEnd",str)
  	  
   with(document.all['qbmenu'].style)
	{
	 width= mwidth
	 height= mheight
	 background= mbgcolor
	 fontSize= fsize
	 fontFamily= fface
	 color= fcolor
	 textAlign= talign
	 fontStyle= fstyle
	 textDecoration= tdecor
	 padding= mpadding
	 borderStyle= mborderstyle
	 borderColor= mbordercolor
	 borderWidth= mborderwidth 
    }
   
   actInit()
  }
  
  mnuobj= document.all['qbmenu']
	  
  var cmd='<a href="" style="font-size:' +fsize+ 'px" onclick="'

  if(mnuobj.style.visibility=='hidden') mnuobj.style.visibility='visible'

  var str0 = 'Ki&#7875;u g&#245; &#273;ang d&#249;ng: '
	   if(ON_OFF==0) str0 +='NONE'
  else if(TYPMOD==0) str0 +='AUTO'
  else if(TYPMOD==1) str0 +='VNI'
  else if(TYPMOD==2) str0 +='TELEX'
  else if(TYPMOD==3) str0 +='VIQR'

  var spell= (SPELL==1) ? '<BR>C&#243;' : '<BR>Kh&#244;ng'
  str0 += spell + ' ki&#7875;m t&#7915; vi&#7879;t'
  
  str = str0
  str += '<hr>' +cmd+ 'ON_OFF=1; TYPMOD++ ; TYPMOD %= 4; qbmenuActivate(); return false">&#272;&#7893;i ki&#7875;u g&#245; [F9]</a>'
  str += '<br>' +cmd+ 'SPELL=1-SPELL; qbmenuActivate(); return false">T&#7855;t m&#7903; ki&#7875;m t&#7915; [F8]</a>'
  str += '<br>' +cmd+ 'ON_OFF=1-ON_OFF; qbmenuActivate(); return false">T&#7855;t m&#7903; b&#7897; g&#245; [F12]</a>'
  str += '<br>' +cmd+ 'remoteControl(); return false">Nh&#7853;p code [Chu&#7897;t ph&#7843;i]</a>'
  str += '<br>' +cmd+ 'hideQBmenu(); return false">D&#7845;u Menu n&#224;y</a>'
  str += '<br>&#169;VietDev V11.0'

  var str1= mnuobj.innerHTML
  var str1= str1.substring(0,str1.indexOf('<HR>'))
  str1= toUnicode(str1)
  str1= str1.replace(/\r/,'')
  str1= str1.replace(/\n/,'')

  if(str1!=str0)
	{
	  mnuobj.innerHTML= str 
	  QBsetCookie(); 
	}
}



function remoteControl()
{
  if(POPWIN!=1 || !TXTOBJ) return;
  formatDialog()
}


function hideQBmenu()
{ 
  document.all['qbmenu'].style.visibility='hidden'
  POPSTATUS=0; statusMessage(); QBsetCookie();

  if(TXTOBJ) TXTOBJ.focus();
  else if(fID) document.frames[fID].focus()
}



function MoveLayTo(idC)
{
  this.First= 1
  this.x = 0
  this.y=0
  this.dx=0
  this.dy=0

  this.objC = document.all[idC].style
  this.moveLayTo = moveQBmenuTo
}


function moveQBmenuTo (np,X1,Y1,WW,HH)
{

  if( WW==0 && HH==0 )
  {
    HH=document.body.offsetHeight
    WW=document.body.offsetWidth
  }

  if ( this.First )
  {
   this.First=0;
   this.objC.left= X1 ; 
   this.objC.top= Y1;  
   this.x = X1 ;
   this.y = Y1
   this.dx = (WW - X1) / np 
   this.dy = (HH - Y1) / np
   return 
  }

  var wPosX = document.body.scrollLeft
  var wPosY = document.body.scrollTop
  var widthC  = parseInt(this.objC.width)
  var heightC = parseInt(this.objC.height)

  WW += ( wPosX - widthC/2)
  HH += ( wPosY - heightC/2)

  this.x += this.dx
  this.y += this.dy

  if( (this.dx>0 && this.x>=WW) || (this.dx<0 && this.x<=WW) ||
      (this.dy>0 && this.y>=HH) || (this.dy<0 && this.y<=HH)
    )
   { this.x= WW ; this.y=HH }

  this.objC.left = this.x
  this.objC.top  = this.y

}




function keyDownInit(key)
{
  if(key==32||key==13||key==8) ENGLISH=0;
  if(key==120){ON_OFF=1; TYPMOD++ ; TYPMOD %= 4 } // F9  =0/1/2/3=AUTO/VNI/TELEX/VIQR
  else if(key==123){ON_OFF=1-ON_OFF} // F12
  else if(key==119){SPELL=1-SPELL} // F8
  if(key==120 || key==123 || key==119)
   {
	 if(POPSTATUS==1) qbmenuActivate()
	 else statusMessage()
   }
}




function QBsetCookie()
{
  var now = new Date();
  var exp = new Date(now.getTime() + 1000*60*60*24*365);
  exp= exp.toGMTString();

  document.cookie = 'VTYPMOD='+ TYPMOD + '; expires='+ exp;
  document.cookie = 'VSPELL='+ SPELL + '; expires='+ exp;
  document.cookie = 'VONOFF='+ ON_OFF + '; expires='+ exp;
  document.cookie = 'VSTATUS='+ POPSTATUS + '; expires='+ exp;
}


function QBgetCookie()
{
  var cookie= document.cookie ;
  var reg= eval('/VSPELL/');
  var res= reg.test(cookie) ;  
  if(res)
  {
   var cookieA= cookie.split('; ')
   var pair ;
   for(var i=0; i<cookieA.length; i++)
   	{
	 pair= cookieA[i].split('=')
   	      if(pair[0]=='VSPELL') SPELL= pair[1];
   	 else if(pair[0]=='VONOFF') ON_OFF= pair[1];
   	 else if(pair[0]=='VTYPMOD') TYPMOD= pair[1];
	 else if(pair[0]=='VSTATUS') POPSTATUS= pair[1];
   	}
  }
 else { QBsetCookie() }
}


QBgetCookie();




/************* statusMessage  **********************/
function statusMessage()
{
  var str = 'Mode: '
	   if(ON_OFF==0) str +='NONE'
  else if(TYPMOD==0) str +='AUTO'
  else if(TYPMOD==1) str +='VNI'
  else if(TYPMOD==2) str +='TELEX'
  else if(TYPMOD==3) str +='VIQR'

  str += (SPELL==1) ? '+SPELLING' : ''
  str += "  [F8=Spelling; F9=TypingMode; F12=On/Off; RightMouse=Help] (c) Vietdev V11.0 (11/2002)";

  status= str
  QBsetCookie()
}