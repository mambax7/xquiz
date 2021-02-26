<table  cellspacing='1' cellpadding='3' border='0' class='outer'>
	<{foreach item=quiz from=$block}>
		<{if $quiz.status==1}>
			<tr>
				<{if $quiz.active==1}>
					<td>
						<a href="<{$xoops_url}>/modules/quiz/quiz.php?act=v&q=<{$quiz.id}>">
							<{$quiz.name}>
						</a>
					</td>
					<td>
						
							<{$smarty.const._MB_QUIZ_ACTIVE}>
				
					</td>
					<{else}>
					<td>
						<a href="<{$xoops_url}>/modules/quiz/?act=s&q=<{$quiz.id}>">
							<{$quiz.name}>
						</a>
					</td>
					<td>
						<a href="<{$xoops_url}>/modules/quiz/?act=s&q=<{$quiz.id}>">
							<{$smarty.const._MB_QUIZ_UNACTIVE}>
						</a>	
					</td>
				<{/if}>	
			</tr>
		<{/if}>	
	<{/foreach}>
</table>
