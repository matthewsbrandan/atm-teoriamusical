drop database if exists bd_atm;
	create database bd_atm;
    
    use bd_atm;
    create table nivel(
		id int(4) not null auto_increment primary key,
		nivel int(4) not null,
        aula enum('Teclado','Guitarra','Violão','Primeiro Log')
    );
    create table alunos(
		id int(4) not null auto_increment primary key,
        nome varchar(30) not null,
        dtEntrada date not null,
        email varchar(30) not null unique,
        celular varchar(15) null,
        aula enum('Teclado','Guitarra','Violão') not null,
        senha varchar(100) not null,
        diaPg enum('1','2','3','4','5','6','7','8','9','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24','25','26','27','28') null,
        dia varchar(20) default 'À Combinar',
        liberacao boolean default false,
        nivelId int(4) default 1,
        pg enum('Em dia','Pendente') default 'Pendente',
        modalidade enum('Presencial','Semi-Presencial') default 'Presencial',
        termo boolean default false,
        promocao decimal(5,2) default 90.00,
        foreign key (nivelId) references nivel(id)
    );
    create table ppt(
		id int(4) not null auto_increment primary key,
		nomeImg varchar(30) not null,
        nomePdf varchar(30) not null unique,
        tituloArq varchar(50) not null,
        nivelId int(4) not null,
        aula enum('Teclado','Guitarra','Violão'),
        foreign key (nivelId) references nivel(id)
    );
    create table exerc(
		id int(4) not null auto_increment primary key,
		urlExerc varchar(30) not null,
        imgExerc varchar(30) not null,
        tituloExerc varchar(50) not null,
        nivelId int(4) not null,
        aula enum('Teclado','Guitarra','Violão'),
        foreign key(nivelId) references nivel(id)
    );
    create table audio(
		id int(4) not null auto_increment primary key,
		nomeAud varchar(50) not null,
        tituloAud varchar(50) not null,
        urlComplemento varchar(50) not null,
        tipo enum('Sequência de Acordes','Exercício de Mobilidade','Escalas'),
        dificuldade enum('Padrão','Pró'),
        nivelId int(4) not null,
        aula enum('Teclado','Guitarra','Violão'),
        tamanho int(4) default 300,
        foreign key (nivelId) references nivel(id)
    );
    create table objetivo(
		id int(4) not null auto_increment primary key,
        urlObj varchar(50) not null,
        tituloObj varchar(100) not null,
        descricao varchar(150) not null,
        nivelId int(4) not null,
        aula enum('Teclado','Guitarra','Violão'),
        onclick boolean default false,
        foreign key(nivelId) references nivel(id)
    );
    create table pagamento(
		id int(4) not null auto_increment primary key,        
        dataPg date not null,
        aluno int(4) not null,
        foreign key (aluno) references alunos(id)
    );
    create table objaluno(
		id int(4) not null auto_increment primary key,
        alunoId int(4) not null,
        objId int(4) not null,
        concluido boolean default false,
        foreign key(alunoId) references alunos(id),
        foreign key(objId) references objetivo(id)
    );
    create table notificaroot(
		id int(4) not null auto_increment primary key,
        alunoId int(4) not null,
        acao varchar(100) not null,
        vista boolean default false
    );
    create table musicas(
		id int(4) not null auto_increment primary key,
        url varchar(100) not null,
        nome varchar(50) not null,
        recomendacao varchar(50) default 'Sem Recomendações',
        aula enum('Teclado','Guitarra','Violão','Todos') default 'Todos'
    );
    create table apps(
		id int(4) not null auto_increment primary key,
        img varchar(30) not null,
        url varchar(100) not null,
        nome varchar(30) not null,
        descricao varchar(100) not null,
        aula enum('Teclado','Guitarra','Violão','Todos') default 'Todos'
    );    
    create table respondeexerc(
		id int(4) not null auto_increment primary key,
        alunoId int(4) not null,
        exercId int(4) not null,
        q1 varchar(200) not null,
        q2 varchar(200) not null,
        q3 varchar(200) not null,
        q4 varchar(200) not null,
        q5 varchar(200) null,
        q6 varchar(200) null,
        q7 varchar(200) null,
        q8 varchar(200) null,
        q9 varchar(200) null,
        q10 varchar(200) null,
        q11 varchar(200) null,
        q12 varchar(200) null,
        q13 varchar(200) null,
        q14 varchar(200) null,
        q15 varchar(200) null,
        q16 varchar(200) null,
        q17 varchar(200) null,
        q18 varchar(200) null,
        q19 varchar(200) null,
        q20 varchar(200) null,
        q21 varchar(200) null,
        q22 varchar(200) null,
        foreign key (alunoId) references alunos(id),
        foreign key (exercId) references exerc(id)
    );
    create table manutencao(
		id int(3) not null primary key auto_increment,
        data_m date not null,
        motivo varchar(1000) not null,
        status_m bool default true
    );
    
    delimiter $$
    create procedure altSemana(in pdia varchar(20), in pid int(4))
    begin
		declare frase varchar(100) default (concat('Alteração dia(Semanal) de Aula de: (',(select dia from alunos where id = pid),') para: (',pdia,')'));
		insert notificaroot(alunoId,acao) values (pid,frase);
        update alunos set dia=pdia where id=pid;
    end $$
    create procedure porcNivel(in pnivelId int(4),in pid int(4))
    begin
		declare numNivel int(4) default(select nivel from nivel where id=pnivelId);
        declare nomAula varchar(30) default (select aula from nivel where id=pnivelId);
		declare numObj int(3) default (select count(*) from objetivo where nivelId=pnivelId);
        declare numConcluido int(3) default (select count(*) from objaluno oa inner join objetivo ob on oa.objId=ob.id where ob.nivelId=pnivelId and oa.concluido=true and oa.alunoId=pid);
        if(numObj=0) then
			select '0' porc;
		else
			if((select round((numConcluido*100)/numObj))=100)
            then
				if(select id from nivel where nivel=(numNivel+1) and aula=nomAula)
                then
					update alunos set nivelId=(select id from nivel where nivel=(numNivel+1) and aula=nomAula) where id=pid;
                    select 'Subiu' porc,(select id from nivel where nivel=(numNivel+1) and aula=nomAula) nivel;
                end if;
            else
				select round((numConcluido*100)/numObj) porc;
			end if;
        end if;
    end $$    
    create procedure sobNivel()
    begin
		declare maximo int default ((select max(nivel) max from nivel)+1);
        insert nivel(nivel,aula) values (maximo,'Teclado'),(maximo,'Violão'),(maximo,'Guitarra');
    end $$
    create procedure atualizaPg()
    begin
		declare pgId int(4) default 0;
        declare cont int default 0;
        declare paga int default (select count(*) from pagamento where month(dataPg)=month(now()) and year(dataPg)=year(now()));
		update alunos set pg='Pendente';
        repeticao : loop
			if(cont<paga)
			then
				update alunos set pg='Em dia' where id=(select aluno from pagamento where month(dataPg)=month(now()) and year(dataPg)=year(now()) limit 1 offset cont);
                set cont= cont+1;
			else
				leave repeticao;
			end if;
		end loop repeticao;
    end $$
    create procedure pgNow(in pid int(4))
    begin
		insert pagamento(dataPg,aluno) values (date_format(now(),'%Y-%m-%d'),pid);
    end $$
    create procedure remPg(in pid int(4))
    begin
		delete from pagamento where aluno=pid and month(dataPg)=month(now());
    end $$
    create procedure cadPpt(in pnomeImg varchar(30),in pnomePdf varchar(30),in ptituloArq varchar(50),in pnivelId int(4),in paula enum('Teclado','Guitarra','Violão'))
    begin
		insert ppt(nomeImg,nomePdf,tituloArq,nivelId,aula) values(pnomeImg,pnomePdf,ptituloArq,pnivelId,paula);
    end $$
    create procedure atualizaObjAlu(in paula varchar(30))
    begin
		declare aid int(4) default 0;
        declare oid int(4) default 0;
        declare contA int default 0;
        declare qtdO int default (select count(*) from objetivo where aula=paula);
        declare contO int default 0;
        
        repeticao:loop
			if(contO<qtdO)then
				set oid = (select id from objetivo where aula=paula limit 1 offset contO);
                set contA = (select count(*) from alunos where aula=paula);
                cadeia : loop
					if(contA>0) then
						set contA = contA -1;
						set aid = (select id from alunos where aula=paula limit 1 offset contA);
                        if((select count(*) from objaluno where alunoId=aid and objId=oid)=0) then
							insert objaluno (alunoId,objId) values (aid,oid);
						end if;
					else
						leave cadeia;
					end if;
                end loop cadeia;
                set contO = contO +1;
			else
				leave repeticao;
			end if;
        end loop repeticao;
    end $$
    create trigger trg_liga_obj after insert on objetivo for each row begin
		declare aid int(4) default 0;
        declare cont int default (select count(*) from alunos where aula=new.aula);
        repeticao: loop
			if(cont>0) then
				set cont = cont -1;
				set aid = (select id from alunos where aula=new.aula limit 1 offset cont);
				insert objaluno (alunoId,objId) values (aid,new.id);
            else
				leave repeticao;
            end if;
        end loop repeticao;
    end $$
    delimiter ;
    
    insert nivel(nivel,aula) values (0,'Primeiro Log'),(1,'Teclado'),(1,'Violão'),(1,'Guitarra');