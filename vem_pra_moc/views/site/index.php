<?php

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Consultório Vem pra Moc';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Bem-vindo ao Consultório Vem para Moc!</h1>
        <p class="lead">Gerencie seus pacientes, médicos e consultas de forma eficiente.</p>
    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-4">
                <h2>Gerenciar Pacientes</h2>
                <p>Gerencie os pacientes cadastrados no sistema.</p>
                <p><?= Html::a('Gerenciar Pacientes', ['paciente/index'], ['class' => 'btn btn-success']) ?></p>
            </div>
            <div class="col-lg-4">
                <h2>Gerenciar Médicos</h2>
                <p>Gerencie novos médicos, atribua especialidades e gerencie horários de atendimento.</p>
                <p><?= Html::a('Gerenciar Médicos', ['medico/index'], ['class' => 'btn btn-success']) ?></p>
            </div>
            <div class="col-lg-4">
                <h2>Especialidades Médicas</h2>
                <p>Gerencie as especialidades médicas disponíveis no consultório.</p>
                <p><?= Html::a('Gerenciar Especialidades', ['especialidade/index'], ['class' => 'btn btn-success']) ?></p>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-4">
                <h2>Agendamentos e Consultas</h2>
                <p>Agende consultas, gerencie faltas e atrasos, e visualize a agenda dos médicos.</p>
                <p><?= Html::a('Gerenciar Consultas', ['consulta/index'], ['class' => 'btn btn-success']) ?></p>
            </div>
            <div class="col-lg-4">
                <h2>Prontuário Eletrônico</h2>
                <p>Visualize e gerencie os prontuários eletrônicos dos pacientes, incluindo diagnósticos e prescrições.</p>
                <p><?= Html::a('Ver Prontuários', ['prontuario/index'], ['class' => 'btn btn-success']) ?></p>
            </div>
            <div class="col-lg-4">
                <h2>Gestão de Usuários</h2>
                <p>Gerencie os usuários do sistema, incluindo atendentes, médicos e administradores.</p>
                <p><?= Html::a('Gerenciar Usuários', ['usuario/index'], ['class' => 'btn btn-success']) ?></p>
            </div>
        </div>

    </div>
</div>