# Руководство по паттернам: Service, Decorator, Facade

Это руководство объясняет, как правильно создавать сервисы, декораторы и фасады в PHP, используя примеры из проекта.

## Содержание

1. [Архитектура паттернов](#архитектура-паттернов)
2. [Шаг 1: Интерфейс (Interface)](#шаг-1-интерфейс-interface)
3. [Шаг 2: Сервис (Service)](#шаг-2-сервис-service)
4. [Шаг 3: Декоратор (Decorator)](#шаг-3-декоратор-decorator)
5. [Шаг 4: Фасад (Facade/Manager)](#шаг-4-фасад-facademanager)
6. [Лучшие практики](#лучшие-практики)
7. [Пример полного цикла](#пример-полного-цикла)

---

## Архитектура паттернов

```
┌─────────────────────────────────────────┐
│         Фасад (Facade/Manager)          │
│     Упрощенный API для клиентов         │
└──────────────┬──────────────────────────┘
               │ использует
               ▼
┌─────────────────────────────────────────┐
│         Декоратор (Decorator)           │
│    Добавляет функциональность           │
│    (кеширование, логирование и т.д.)    │
└──────────────┬──────────────────────────┘
               │ оборачивает
               ▼
┌─────────────────────────────────────────┐
│         Интерфейс (Interface)           │
│     Контракт для реализации             │
└──────────────┬──────────────────────────┘
               │ реализует
               ▼
┌─────────────────────────────────────────┐
│          Сервис (Service)               │
│    Основная бизнес-логика               │
└─────────────────────────────────────────┘
```

**Принципы:**
- **Интерфейс** определяет контракт (что должен делать сервис)
- **Сервис** содержит чистую бизнес-логику
- **Декоратор** оборачивает сервис и добавляет cross-cutting concerns (кеш, логи, безопасность)
- **Фасад** предоставляет удобный статический API для использования в коде

---

## Шаг 1: Интерфейс (Interface)

**Назначение:** Определить контракт, который должен реализовать сервис.

**Правила:**
- Один интерфейс = одна ответственность
- Методы должны быть описаны понятными именами
- Используйте PHPDoc для документирования

**Пример:** `ModerationServiceInterface.php`

```php
<?php

namespace Dev\Legacy\Service\Moderation;

use Dev\Dto\ModerationCountDto;

interface ModerationServiceInterface
{
    /**
     * Получить количество элементов на модерации
     *
     * @param string|null $city Код города для фильтрации (null для всех городов)
     * @return ModerationCountDto DTO с количеством элементов на модерации
     */
    public function getCount(?string $city = null): ModerationCountDto;

    /**
     * Очистить кеш (если используется кеширование)
     *
     * @param string|null $city Код города (опционально)
     * @return bool
     */
    public function clearCache(?string $city = null): bool;
}
```

**Почему это важно:**
- Позволяет иметь несколько реализаций (например, для тестирования)
- Декоратор может работать с любым объектом, реализующим интерфейс
- Явно описывает, что должен уметь делать сервис

---

## Шаг 2: Сервис (Service)

**Назначение:** Содержит чистую бизнес-логику без побочных эффектов (кеширование, логирование).

**Правила:**
- ✅ Делает ОДНУ вещь хорошо (Single Responsibility Principle)
- ✅ Легко тестировать (нет зависимостей от кеша, БД напрямую)
- ✅ Использует DTO для возврата данных
- ✅ Методы должны быть чистыми функциями (предсказуемый результат)
- ❌ НЕ содержит логирование
- ❌ НЕ содержит кеширование
- ❌ НЕ содержит работу с глобальными переменными (кроме необходимых для Bitrix)

**Пример:** `ModerationService.php`

```php
<?php

namespace Dev\Legacy\Service\Moderation;

use CModule;
use CIBlockElement;
use Dev\Dto\ModerationCountDto;

/**
 * Сервис для подсчета элементов на модерации
 */
class ModerationService implements ModerationServiceInterface
{
    // Константы для магических чисел
    private const IBLOCK_JOB = 14;
    private const STATUS_JOB_MODERATION = 28290;

    /**
     * @inheritDoc
     */
    public function getCount(?string $city = null): ModerationCountDto
    {
        CModule::IncludeModule("iblock");

        $dto = new ModerationCountDto();

        // Делим логику на маленькие методы
        $this->countJobModeration($dto, $city);
        $this->countActionsModeration($dto, $city);
        // ... и т.д.

        // Пересчет итоговых значений
        $dto->calculateTotals();

        return $dto;
    }

    /**
     * Подсчет элементов на модерации в разделе "Работа"
     *
     * @param ModerationCountDto $dto
     * @param string|null $city
     * @return void
     */
    private function countJobModeration(ModerationCountDto $dto, ?string $city): void
    {
        // Чистая бизнес-логика
        $filter = [
            'IBLOCK_ID' => self::IBLOCK_JOB,
            'PROPERTY_STATUS' => self::STATUS_JOB_MODERATION,
        ];

        if ($city !== null) {
            $filter['PROPERTY_CITY'] = $city;
        }

        $count = $this->countElements(self::IBLOCK_JOB, $filter);
        $dto->job = $count;
    }

    /**
     * Подсчет элементов с фильтром
     *
     * @param int $iblockId
     * @param array $filter
     * @return int
     */
    private function countElements(int $iblockId, array $filter): int
    {
        $count = 0;
        $dbRes = CIBlockElement::GetList([], $filter, false, [], ['ID']);
        
        if ($dbRes) {
            while ($dbRes->GetNext()) {
                $count++;
            }
        }

        return $count;
    }

    /**
     * @inheritDoc
     */
    public function clearCache(?string $city = null): bool
    {
        // Базовый сервис не использует кеш, реализация в декораторе
        return true;
    }
}
```

**Ключевые моменты:**
1. **Константы вместо магических чисел** - код становится понятнее
2. **Методы разделены по ответственности** - каждый метод делает одну вещь
3. **Возвращает DTO** - структурированные данные вместо массива
4. **Легко тестировать** - можно мокировать `CIBlockElement`

---

## Шаг 3: Декоратор (Decorator)

**Назначение:** Добавить дополнительную функциональность (кеш, логирование, валидацию) БЕЗ изменения основного сервиса.

**Правила:**
- ✅ Реализует тот же интерфейс, что и декорируемый объект
- ✅ Принимает объект интерфейса в конструкторе (не конкретный класс!)
- ✅ Делегирует вызовы декорируемому объекту
- ✅ Добавляет свою логику ДО или ПОСЛЕ вызова
- ✅ Можно вкладывать декораторы друг в друга (chain of decorators)

**Пример:** `CachedModerationService.php`

```php
<?php

namespace Dev\Legacy\Service\Moderation;

use CPHPCache;
use Dev\Dto\ModerationCountDto;

/**
 * Декоратор для тегированного кеширования результатов ModerationService
 */
class CachedModerationService implements ModerationServiceInterface
{
    // Храним ссылку на декорируемый сервис
    private ModerationServiceInterface $service;
    
    private int $cacheTime;
    private string $cachePath;

    // Теги для кеширования
    private const CACHE_TAG_ALL = 'moderation_count_all';
    private const CACHE_TAG_IBLOCK_JOB = 'moderation_count_iblock_14';

    /**
     * Конструктор принимает интерфейс, а не конкретный класс!
     * Это позволяет оборачивать любой сервис или даже другой декоратор
     */
    public function __construct(
        ModerationServiceInterface $service,  // ← Важно: интерфейс, не класс!
        int $cacheTime = 3600,
        string $cachePath = '/moderationCount/'
    ) {
        $this->service = $service;
        $this->cacheTime = $cacheTime;
        $this->cachePath = $cachePath;
    }

    /**
     * @inheritDoc
     * 
     * Декоратор:
     * 1. Проверяет кеш ДО вызова основного сервиса
     * 2. Если кеш есть - возвращает из кеша
     * 3. Если кеша нет - вызывает основной сервис
     * 4. Сохраняет результат в кеш ПОСЛЕ получения данных
     */
    public function getCount(?string $city = null): ModerationCountDto
    {
        $cacheId = $this->buildCacheId($city);
        $obCache = new CPHPCache;

        // Пытаемся получить данные из кеша (ДО вызова сервиса)
        if ($obCache->InitCache($this->cacheTime, $cacheId, $this->cachePath)) {
            $cachedData = $obCache->GetVars();
            return ModerationCountDto::fromArray($cachedData);
        }

        // Кеш не найден, делегируем вызов основному сервису
        $tags = $this->getCacheTags();
        $obCache->StartDataCache($this->cacheTime, $cacheId, $this->cachePath, $tags);
        
        // ← ВОТ ЗДЕСЬ ВЫЗЫВАЕТСЯ ОСНОВНОЙ СЕРВИС
        $dto = $this->service->getCount($city);

        // Сохраняем в кеш (ПОСЛЕ получения данных)
        $obCache->EndDataCache($dto->toArray());

        return $dto;
    }

    /**
     * @inheritDoc
     */
    public function clearCache(?string $city = null): bool
    {
        $cacheId = $this->buildCacheId($city);
        $obCache = new CPHPCache;
        $obCache->Clean($cacheId, $this->cachePath);
        return true;
    }

    /**
     * Построить ID кеша на основе параметров
     */
    private function buildCacheId(?string $city): string
    {
        $cityPart = $city ? '_city_' . md5($city) : '_all_cities';
        return 'moderation_count_' . $cityPart;
    }

    /**
     * Получить теги для кеширования
     */
    private function getCacheTags(): array
    {
        return [
            self::CACHE_TAG_ALL,
            self::CACHE_TAG_IBLOCK_JOB,
            // ... другие теги
        ];
    }
}
```

**Ключевые моменты:**
1. **`implements ModerationServiceInterface`** - декоратор реализует тот же интерфейс
2. **Принимает `ModerationServiceInterface` в конструкторе** - может обернуть любой объект, реализующий интерфейс
3. **Делегирует вызовы** - `$this->service->getCount($city)` вызывает основной сервис
4. **Добавляет логику до/после** - проверка кеша до, сохранение после

**Цепочка декораторов (опционально):**

```php
// Можно вкладывать декораторы друг в друга:
$baseService = new ModerationService();
$loggedService = new LoggedModerationService($baseService);  // добавляет логирование
$cachedService = new CachedModerationService($loggedService); // добавляет кеширование

// Теперь у нас есть и логирование, и кеширование!
```

---

## Шаг 4: Фасад (Facade/Manager)

**Назначение:** Предоставить простой, удобный статический API для использования в коде проекта.

**Правила:**
- ✅ Статические методы для удобства
- ✅ Скрывает сложность создания объектов (декораторы, зависимости)
- ✅ Может содержать вспомогательные методы для частых операций
- ✅ Использует Singleton паттерн для кешированного экземпляра (опционально)
- ✅ Предоставляет удобные перегрузки методов (например, возврат DTO или массива)

**Пример:** `ModerationManager.php`

```php
<?php

namespace Dev\Legacy\Service\Moderation;

use Bitrix\Main\Application;

/**
 * Менеджер для работы с модерацией (фасад)
 */
class ModerationManager
{
    // Кешируем экземпляр сервиса (Singleton паттерн)
    private static ?ModerationServiceInterface $instance = null;

    /**
     * Получить экземпляр сервиса (с кешированием)
     * Здесь мы создаем цепочку: Service → Decorator
     */
    public static function getInstance(): ModerationServiceInterface
    {
        if (self::$instance === null) {
            // Создаем базовый сервис
            $service = new ModerationService();
            
            // Оборачиваем в декоратор кеширования
            self::$instance = new CachedModerationService($service);
        }

        return self::$instance;
    }

    /**
     * Получить количество элементов на модерации (как массив для обратной совместимости)
     *
     * @param string|null $city Код города для фильтрации
     * @return array Массив с данными
     */
    public static function getCount(?string $city = null): array
    {
        return self::getInstance()->getCount($city)->toArray();
    }

    /**
     * Получить количество элементов на модерации (как DTO)
     *
     * @param string|null $city Код города для фильтрации
     * @return \Dev\Dto\ModerationCountDto DTO объект
     */
    public static function getCountDto(?string $city = null): \Dev\Dto\ModerationCountDto
    {
        return self::getInstance()->getCount($city);
    }

    /**
     * Очистить кеш для конкретного города
     *
     * @param string|null $city Код города (опционально)
     * @return bool
     */
    public static function clearCache(?string $city = null): bool
    {
        return self::getInstance()->clearCache($city);
    }

    /**
     * Получить количество элементов на модерации для страницы модерации
     * Вспомогательный метод, который обрабатывает сессию и фильтры
     *
     * @param \CMain|null $application Объект APPLICATION
     * @return array Массив с данными модерации
     */
    public static function getCountForPage(?\CMain $application = null): array
    {
        $session = Application::getInstance()->getSession();

        // Обработка фильтра из POST
        if (isset($_POST["filterSettings"]) && strlen($_POST["filterSettings"]) > 0) {
            $session->set('moderationFilterSettings', $_POST["filterSettings"]);
        }

        // Определяем город для фильтрации
        $city = \Dev\Core\Support\Helpers::getCity();

        // Если находимся на странице модерации и фильтр установлен в 0, сбрасываем город
        if ($application === null) {
            global $APPLICATION;
            $application = $APPLICATION;
        }

        if (isset($application) && substr($application->GetCurDir(), 0, 21) == '/Personal/Moderation/') {
            if ($session->has('moderationFilterSettings') && $session['moderationFilterSettings'] == 0) {
                $city = null;
            }
        }

        $city = $city !== null ? (string)$city : null;

        // Делегируем вызов сервису
        return self::getCount($city);
    }
}
```

**Использование в коде:**

```php
// Просто и понятно:
$count = ModerationManager::getCount($city);

// Или для страницы модерации (с обработкой сессии):
$count = ModerationManager::getCountForPage($APPLICATION);

// Или получить DTO:
$dto = ModerationManager::getCountDto($city);
```

**Ключевые моменты:**
1. **Статические методы** - удобно использовать без создания экземпляра
2. **`getInstance()` создает цепочку** - скрывает сложность от клиента
3. **Вспомогательные методы** - `getCountForPage()` объединяет часто используемую логику
4. **Перегрузки** - `getCount()` возвращает массив, `getCountDto()` возвращает DTO

---

## Лучшие практики

### 1. Структура файлов

```
local/php_interface/lib/Dev/Legacy/Service/Moderation/
├── ModerationServiceInterface.php    # Интерфейс
├── ModerationService.php              # Базовый сервис
├── CachedModerationService.php        # Декоратор кеширования
└── ModerationManager.php              # Фасад/Менеджер
```

### 2. Именование

- **Интерфейс:** `{ServiceName}Interface` или `I{ServiceName}`
- **Сервис:** `{ServiceName}Service`
- **Декоратор:** `{Feature}{ServiceName}Service` (например, `CachedModerationService`, `LoggedModerationService`)
- **Фасад:** `{ServiceName}Manager` или `{ServiceName}Facade`

### 3. Что НЕ должно быть в сервисе

❌ **НЕ размещайте в сервисе:**
- Логирование (это для декоратора)
- Кеширование (это для декоратора)
- Работа с глобальными переменными (кроме необходимых для Bitrix API)
- HTML-вывод
- Прямые SQL-запросы (используйте Bitrix API)

✅ **Размещайте в сервисе:**
- Бизнес-логику
- Работу с данными через Bitrix API
- Валидацию данных
- Трансформацию данных

### 4. Тестирование

**Сервис легко тестируется:**

```php
// В тестах можно использовать моки
$mockService = $this->createMock(ModerationServiceInterface::class);
$mockService->expects($this->once())
    ->method('getCount')
    ->with('1932')
    ->willReturn(new ModerationCountDto());

// Декоратор тоже легко тестируется
$decorator = new CachedModerationService($mockService);
$result = $decorator->getCount('1932');
```

### 5. Когда использовать декоратор

Используйте декоратор для:
- ✅ Кеширования
- ✅ Логирования
- ✅ Валидации
- ✅ Аутентификации/авторизации
- ✅ Транзакций
- ✅ Retry логики
- ✅ Rate limiting

**НЕ используйте декоратор для:**
- ❌ Изменения возвращаемых данных (для этого лучше другой метод в сервисе)
- ❌ Бизнес-логики (это для сервиса)

---

## Пример полного цикла

### Создание нового сервиса "Нотификации"

**Шаг 1: Создаем интерфейс**

```php
<?php
// NotificationServiceInterface.php

namespace Dev\Legacy\Service\Notification;

use Dev\Dto\NotificationDto;

interface NotificationServiceInterface
{
    public function send(string $userId, string $message): bool;
    public function getUnreadCount(string $userId): int;
}
```

**Шаг 2: Создаем базовый сервис**

```php
<?php
// NotificationService.php

namespace Dev\Legacy\Service\Notification;

class NotificationService implements NotificationServiceInterface
{
    public function send(string $userId, string $message): bool
    {
        // Чистая бизнес-логика отправки
        // ...
        return true;
    }

    public function getUnreadCount(string $userId): int
    {
        // Чистая бизнес-логика подсчета
        // ...
        return 0;
    }
}
```

**Шаг 3: Создаем декоратор кеширования**

```php
<?php
// CachedNotificationService.php

namespace Dev\Legacy\Service\Notification;

class CachedNotificationService implements NotificationServiceInterface
{
    private NotificationServiceInterface $service;
    private int $cacheTime;

    public function __construct(
        NotificationServiceInterface $service,
        int $cacheTime = 300
    ) {
        $this->service = $service;
        $this->cacheTime = $cacheTime;
    }

    public function send(string $userId, string $message): bool
    {
        // Отправляем уведомление
        $result = $this->service->send($userId, $message);
        
        // Инвалидируем кеш счетчика
        if ($result) {
            $this->clearCache($userId);
        }
        
        return $result;
    }

    public function getUnreadCount(string $userId): int
    {
        $cacheId = 'notification_count_' . $userId;
        $obCache = new \CPHPCache;

        if ($obCache->InitCache($this->cacheTime, $cacheId, '/notifications/')) {
            return (int)$obCache->GetVars();
        }

        $obCache->StartDataCache($this->cacheTime, $cacheId, '/notifications/');
        $count = $this->service->getUnreadCount($userId);
        $obCache->EndDataCache($count);

        return $count;
    }

    private function clearCache(string $userId): void
    {
        $cacheId = 'notification_count_' . $userId;
        $obCache = new \CPHPCache;
        $obCache->Clean($cacheId, '/notifications/');
    }
}
```

**Шаг 4: Создаем фасад**

```php
<?php
// NotificationManager.php

namespace Dev\Legacy\Service\Notification;

class NotificationManager
{
    private static ?NotificationServiceInterface $instance = null;

    public static function getInstance(): NotificationServiceInterface
    {
        if (self::$instance === null) {
            $service = new NotificationService();
            self::$instance = new CachedNotificationService($service);
        }

        return self::$instance;
    }

    public static function send(string $userId, string $message): bool
    {
        return self::getInstance()->send($userId, $message);
    }

    public static function getUnreadCount(string $userId): int
    {
        return self::getInstance()->getUnreadCount($userId);
    }
}
```

**Использование:**

```php
// В коде проекта
$count = NotificationManager::getUnreadCount('123');
NotificationManager::send('123', 'Новое сообщение');
```

---

## Заключение

Паттерны Service → Decorator → Facade позволяют:

1. ✅ **Разделить ответственность** - каждый класс делает одну вещь
2. ✅ **Легко тестировать** - можно мокировать зависимости
3. ✅ **Расширять функциональность** - декораторы можно добавлять без изменения сервиса
4. ✅ **Упростить использование** - фасад предоставляет простой API
5. ✅ **Переиспользовать код** - сервисы можно использовать в разных контекстах

**Помните:** Начинайте с простого сервиса, добавляйте декораторы по мере необходимости!

