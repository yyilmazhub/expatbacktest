<?
namespace App\Tests;

use App\Service\FormJsonService;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\JsonResponse;

class FormJsonServiceTest extends TestCase
{
//     public function testCreateSuccessResponse(): void
//     {
//         $formJsonService = new FormJsonService();
//         $redirectRoute = '/success';
//         $category = 'example';

//         $expectedResponse = new JsonResponse([
//             'code' => '200',
//             'html' => $redirectRoute,
//             'category' => $category,
//         ]);

//         $response = $formJsonService->createSuccessResponse($redirectRoute, $category);

//         $this->assertEquals($expectedResponse->getContent(), $response->getContent());
//         $this->assertEquals($expectedResponse->getStatusCode(), $response->getStatusCode());
//     }

//     public function testCreateErrorResponse(): void
//     {
//         $formJsonService = new FormJsonService();
//         $errors = ['field1' => 'Error 1', 'field2' => 'Error 2'];

//         $expectedResponse = new JsonResponse([
//             'code' => '400',
//             'errors' => $errors,
//         ]);

//         $response = $formJsonService->createErrorResponse($errors);

//         $this->assertEquals($expectedResponse->getContent(), $response->getContent());
//         $this->assertEquals($expectedResponse->getStatusCode(), $response->getStatusCode());
//     }
// 
}
