<?php
/*
 *  $Id: DbDeployTask.php 59 2006-04-28 14:49:47Z lcrouch $
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS
 * "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT
 * LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR
 * A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT
 * OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL,
 * SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT
 * LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE,
 * DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY
 * THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
 * (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE
 * OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 *
 * This software consists of voluntary contributions made by many individuals
 * and is licensed under the LGPL. For more information please see
 * <http://phing.info>.
 */

require_once 'phing/Task.php';
require_once 'phing/tasks/ext/dbdeploy/DbmsSyntax.php';

/**
 *  Factory for generating dbms-specific syntax-generating objects
 *
 *  @author   Luke Crouch at SourceForge (http://sourceforge.net)
 *  @version  $Revision: 1.1 $
 *  @package  phing.tasks.ext.dbdeploy
 */

class DbmsSyntaxFactory {
	private $dbms;

	public function __construct($dbms) {
		$this->dbms = $dbms;
	}

	public function getDbmsSyntax() {
		switch ($this->dbms) {
		case ('sqlite'):
			require_once 'phing/tasks/ext/dbdeploy/DbmsSyntaxSQLite.php';
			return new DbmsSyntaxSQLite();
		case ('mysql'):
			require_once 'phing/tasks/ext/dbdeploy/DbmsSyntaxMysql.php';
			return new DbmsSyntaxMysql();
		case ('mssql'):
			require_once 'phing/tasks/ext/dbdeploy/DbmsSyntaxMsSql.php';
			return new DbmsSyntaxMsSql();
		default:
			throw new Exception(
					$this->dbms . ' is not supported by dbdeploy task.');
		}
	}
}

