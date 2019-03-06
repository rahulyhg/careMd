{{* Smarty Template - mainframe.tpl 2004-06-11 Elpidio Latorilla *}}
{{* This is the main template that frames the main work page *}}

{{config_load file=test.conf section="setup"}}

{{include file="common/header.tpl"}}

{{if not $bHideTitleBar}}
        <tr>
            <td  valign="top" align="middle" height="35">
                {{include file="common/header_topblock.tpl"}}
            </td>
        </tr>
        {{/if}}

<table class="table table-bordered table-condensed table-hover" cellspacing=0 height=100%>
    <tbody class="">
        

        <tr>
            <td bgcolor={{$body_bgcolor}} valign=top>

                {{* Note the ff: conditional block must always go together *}}
                {{if $sMainBlockIncludeFile ne ""}}
                {{include file=$sMainBlockIncludeFile}}
                {{/if}}
                {{if $sMainFrameBlockData ne ""}}
                {{$sMainFrameBlockData}}
                {{/if}}
                {{* end of conditional block *}}

            </td>
        </tr>

        {{if $sCopyright}}
        <tr valign=top >
            <td bgcolor={{$bot_bgcolor}}>
                {{if not $bHideCopyright}}
                {{include file="common/copyright.tpl"}}
                {{/if}}
            </td>
        </tr>
        {{/if}}

    </tbody>
</table>




{{include file="common/footer.tpl"}}
