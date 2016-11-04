<?php

namespace app\controllers;

use app\models\UserThread;
use Yii;
use app\models\Message;
use app\models\MessageSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * MessagesController implements the CRUD actions for Message model.
 */
class MessagesController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Message models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MessageSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Message model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Message model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Message();

        $content = $_POST['content'];
        $thread_id = $_POST['thread_id'];
        $author_id = $_POST['author_id'];
        $user2 = $_POST['user2'];

        if ($thread_id == 'none') {
            if (UserThread::findOne(['user1_id' => $author_id, 'user2_id' => $user2]) == null &&
                UserThread::findOne(['user1_id' => $user2, 'user2_id' => $author_id]) == null)
                $thread_id = $this->createThread($author_id, $user2);
        }

        $model->setAttributes([
            'content' => $content,
            'thread_id' => $thread_id,
            'author_id' => $author_id,
            'content_type' => 'text'
        ]);

        if($model->save())
            return $thread_id;
        else
            return "Failure";
    }

    /**
     * Updates an existing Message model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Message model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionGetUserThread($user1, $user2)
    {
        $thread = UserThread::findOne(['user1_id' => $user1, 'user2_id' => $user2]);
        if ($thread == null)
            $thread = UserThread::findOne(['user1_id' => $user2, 'user2_id' => $user1]);

        if($thread == null) {
            $thread_id = $this->createThread($user1, $user2);
            $returnData = ["thread_id" => $thread_id, "messages" => []];
        }
        else {
            $messages = Message::find()
                ->where(['thread_id' => $thread->id])
                ->orderBy('created_time')
                ->all();

            $returnData = ["thread_id" => $thread->id, "messages" => $messages];
        }

        $response = Yii::$app->response;
        $response->format = \yii\web\Response::FORMAT_JSON;
        $response->data = $returnData;

        return $returnData;
    }

    /**
     * Finds the Message model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Message the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Message::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    protected function createThread($user1, $user2) {
        $thread = new UserThread();
        $thread->setAttributes(['user1_id' => $user1, 'user2_id' => $user2]);
        if ($thread->save())
            return $thread->id;
        else
            return 0;
    }
}
