<?php


$content = <<<EOS
				<div class="panel" id="panel-fs">
					<h4>File(s) or Directory</h4>
					<p class="ui-row">
						<span class="btn icon-home"></span>
						<span class="btn icon-up-directory"></span>
						<input type="text" id="target-fs-path" value="{$init_fs}">
					</p>
					<p id="target-fs" class="sub-panel">
					
					</p>
					<span class="info-box" title="The Base Directory is Set in Settings"></span>
				</div>

EOS;

