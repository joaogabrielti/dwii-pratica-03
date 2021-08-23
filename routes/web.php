<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('aluno')->group(function () {
    Route::get('', function () {
        $alunos = ['Ana', 'Bruno', 'Carol', 'Danilo', 'Ellen'];
        echo("<ul>");
        foreach ($alunos as $key => $value) {
            echo("<li>".($key+1)." - ".$value."</li>");
        }
        echo("</ul>");
    })->name('aluno');

    Route::get('limite/{limite}', function ($limite) {
        $alunos = ['Ana', 'Bruno', 'Carol', 'Danilo', 'Ellen'];
        echo("<ul>");
        for ($i = 0; $i < $limite; $i++) {
            echo("<li>".($i+1)." - ".$alunos[$i]."</li>");
        }
        echo("</ul>");
    })->name('aluno.limite')->where('limite', '[0-9]+');

    Route::get('matricula/{matricula}', function ($matricula) {
        $alunos = ['Ana', 'Bruno', 'Carol', 'Danilo', 'Ellen'];
        if ($matricula <= count($alunos)) {
            echo("<ul><li>".$matricula." - ".$alunos[$matricula-1]."</li></ul>");
        } else {
            echo("NÃO ENCONTRADO!");
        }
    })->name('aluno.matricula')->where('matricula', '[0-9]+');

    Route::get('nome/{nome}', function ($nome) {
        $alunos = ['Ana', 'Bruno', 'Carol', 'Danilo', 'Ellen'];

        $flag = false;
        foreach ($alunos as $key => $value) {
            if ($nome == $value) {
                echo("<li>".($key+1)." - ".$value."</li>");
                $flag = true;
                break;
            }
        }

        if (!$flag) {
            echo("NÃO ENCONTRADO!");
        }
    })->name('aluno.nome')->where('nome', '[a-zA-Z]+');
});

Route::prefix('nota')->group(function () {
    Route::get('', function () {
        $alunos = [['Ana', 9], ['Bruno', 2], ['Carol', 8], ['Danilo', 6], ['Ellen', 4]];
        echo("<table><thead><th>Matrícula</th><th>Aluno</th><th>Nota</th></thead><tbody>");
        foreach ($alunos as $key => $value) {
            echo("<tr><td>".($key+1)."</td><td>".$value[0]."</td><td>".$value[1]."</td></tr>");
        }
        echo("</tbody></table>");
    })->name('nota');

    Route::get('limite/{limite}', function ($limite) {
        $alunos = [['Ana', 9], ['Bruno', 2], ['Carol', 8], ['Danilo', 6], ['Ellen', 4]];
        echo("<table><thead><th>Matrícula</th><th>Aluno</th><th>Nota</th></thead><tbody>");
        for ($i = 0; $i < $limite; $i++) {
            echo("<tr><td>".($i+1)."</td><td>".$alunos[$i][0]."</td><td>".$alunos[$i][1]."</td></tr>");
        }
        echo("</tbody></table>");
    })->name('nota.limite')->where('limite', '[0-9]+');

    Route::get('lancar/{nota}/{matricula}/{nome?}', function ($nota, $matricula, $nome=null) {
        $alunos = [['Ana', 9], ['Bruno', 2], ['Carol', 8], ['Danilo', 6], ['Ellen', 4]];
        $aluno = null;
        if ($nome !== null) {
            foreach ($alunos as $key => $value) {
                if ($nome == $value[0]) {
                    $aluno = $key;
                    break;
                }
            }
        } else {
            if ($matricula <= count($alunos)) {
                $aluno = $matricula-1;
            }
        }

        if ($aluno === null) {
            echo("NÃO ENCONTRADO!");
        } else {
            $alunos[$aluno][1] = $nota;
            echo("<table><thead><th>Matrícula</th><th>Aluno</th><th>Nota</th></thead><tbody>");
            foreach ($alunos as $key => $value) {
                echo("<tr><td>".($key+1)."</td><td>".$value[0]."</td><td>".$value[1]."</td></tr>");
            }
            echo("</tbody></table>");
        }
    })->name('nota.lancar')->where('nota', '[0-9]+')->where('matricula', '[0-9]+')->where('nome', '[a-zA-Z]+');

    Route::get('conceito/{A}/{B}/{C}', function ($A, $B, $C) {
        $alunos = [['Ana', 9], ['Bruno', 2], ['Carol', 8], ['Danilo', 6], ['Ellen', 4]];
        echo("<table><thead><th>Matrícula</th><th>Aluno</th><th>Conceito</th></thead><tbody>");
        foreach ($alunos as $key => $value) {
            echo("<tr><td>".($key+1)."</td><td>".$value[0]."</td><td>");
            if ($value[1] >= $A) echo("A");
            else if ($value[1] >= $B) echo("B");
            else if ($value[1] >= $C) echo("C");
            else echo("D");
            echo("</td></tr>");
        }
        echo("</tbody></table>");
    })->name('nota.conceito')->where('A', '[0-9]+')->where('B', '[0-9]+')->where('C', '[0-9]+');

    Route::post('conceito/{A}/{B}/{C}', function ($A, $B, $C) {
        $alunos = [['Ana', 9], ['Bruno', 2], ['Carol', 8], ['Danilo', 6], ['Ellen', 4]];
        echo("<table><thead><th>Matrícula</th><th>Aluno</th><th>Conceito</th></thead><tbody>");
        foreach ($alunos as $key => $value) {
            echo("<tr><td>".($key+1)."</td><td>".$value[0]."</td><td>");
            if ($value[1] >= $A) echo("A");
            else if ($value[1] >= $B) echo("B");
            else if ($value[1] >= $C) echo("C");
            else echo("D");
            echo("</td></tr>");
        }
        echo("</tbody></table>");
    })->where('A', '[0-9]+')->where('B', '[0-9]+')->where('C', '[0-9]+');
});
