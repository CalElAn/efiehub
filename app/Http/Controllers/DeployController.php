<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

class DeployController extends Controller
{
  public function deploy(Request $request)
  {
     $githubPayload = $request->getContent();
     $githubHash = $request->header('X-Hub-Signature-256');
     $localToken = config('app.deploy_secret');
     $localHash = 'sha256=' . hash_hmac('sha256', $githubPayload, $localToken, false);
     if (hash_equals($githubHash, $localHash)) {
          //$root_path = base_path();
	  //$process = new Process(['cd', $root_path]);
	  //$process->run();
	  //$process = new Process(['./deploy.sh']);
          //$process->run();
	  /*$process = new Process(['npm', 'v']);
	  $process->run();

if (!$process->isSuccessful()) {
    throw new ProcessFailedException($process);
}

echo $process->getOutput();*/
	$output = shell_exec('cd '.base_path().'; ./deploy.sh');
	echo $output;
     } 

  }
}
