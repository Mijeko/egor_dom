# Шпаргалка: Service, Decorator, Facade

## 🎯 Быстрая справка

### Структура паттернов

```
Facade (Manager)
    ↓ использует
Decorator (CachedService)
    ↓ оборачивает
Interface
    ↓ реализует
Service (базовая логика)
```

---

## 📋 Шаг за шагом

### 1️⃣ Интерфейс (Interface)

```php
interface MyServiceInterface
{
    public function doSomething(string $param): MyDto;
    public function clearCache(?string $id = null): bool;
}
```

**✅ Делает:** Определяет контракт (что должен уметь сервис)

---

### 2️⃣ Сервис (Service)

```php
class MyService implements MyServiceInterface
{
    private const SOME_CONST = 123;
    
    public function doSomething(string $param): MyDto
    {
        // Чистая бизнес-логика
        $dto = new MyDto();
        // ...
        return $dto;
    }
    
    public function clearCache(?string $id = null): bool
    {
        return true; // Базовый сервис не кеширует
    }
}
```

**✅ Делает:** Содержит бизнес-логику  
**❌ НЕ делает:** Кеширование, логирование, HTML

---

### 3️⃣ Декоратор (Decorator)

```php
class CachedMyService implements MyServiceInterface
{
    private MyServiceInterface $service; // ← Интерфейс, не класс!
    
    public function __construct(MyServiceInterface $service)
    {
        $this->service = $service;
    }
    
    public function doSomething(string $param): MyDto
    {
        // 1. Проверяем кеш ДО
        if ($cached = $this->getFromCache($param)) {
            return $cached;
        }
        
        // 2. Вызываем основной сервис
        $dto = $this->service->doSomething($param);
        
        // 3. Сохраняем в кеш ПОСЛЕ
        $this->saveToCache($param, $dto);
        
        return $dto;
    }
}
```

**✅ Делает:** Добавляет кеширование, логирование и т.д.  
**✅ Принимает:** Интерфейс в конструкторе

---

### 4️⃣ Фасад (Facade/Manager)

```php
class MyManager
{
    private static ?MyServiceInterface $instance = null;
    
    public static function getInstance(): MyServiceInterface
    {
        if (self::$instance === null) {
            $service = new MyService();
            self::$instance = new CachedMyService($service);
        }
        return self::$instance;
    }
    
    public static function doSomething(string $param): array
    {
        return self::getInstance()->doSomething($param)->toArray();
    }
}
```

**✅ Делает:** Предоставляет простой статический API

---

## 🔑 Ключевые принципы

### Сервис
- ✅ Одна ответственность
- ✅ Чистая бизнес-логика
- ✅ Легко тестируется
- ❌ Без кеша
- ❌ Без логов

### Декоратор
- ✅ Реализует тот же интерфейс
- ✅ Принимает интерфейс в конструкторе
- ✅ Делегирует вызовы основному сервису
- ✅ Добавляет функциональность до/после

### Фасад
- ✅ Статические методы
- ✅ Скрывает сложность создания объектов
- ✅ Удобный API для клиентов

---

## 📝 Пример использования

```php
// В коде проекта
$data = MyManager::doSomething('param');
MyManager::clearCache('id');
```

---

## 🎨 Именование

| Тип | Паттерн имени |
|-----|---------------|
| Интерфейс | `{Name}Interface` или `I{Name}` |
| Сервис | `{Name}Service` |
| Декоратор | `Cached{Name}Service`, `Logged{Name}Service` |
| Фасад | `{Name}Manager` или `{Name}Facade` |

---

## 📂 Структура файлов

```
Service/
├── MyServiceInterface.php    # Интерфейс
├── MyService.php              # Сервис
├── CachedMyService.php        # Декоратор
└── MyManager.php              # Фасад
```

---

## ⚠️ Частые ошибки

1. **❌ Декоратор принимает конкретный класс:**
   ```php
   // ПЛОХО
   public function __construct(MyService $service)
   
   // ХОРОШО
   public function __construct(MyServiceInterface $service)
   ```

2. **❌ Кеширование в сервисе:**
   ```php
   // ПЛОХО - кеш в сервисе
   class MyService {
       public function getData() {
           if ($cached = $this->getCache()) return $cached;
           // ...
       }
   }
   
   // ХОРОШО - кеш в декораторе
   ```

3. **❌ Фасад создает сервис напрямую:**
   ```php
   // ПЛОХО - клиент знает о декораторе
   $service = new CachedMyService(new MyService());
   
   // ХОРОШО - фасад скрывает детали
   $data = MyManager::doSomething('param');
   ```

---

## 🔗 Смотрите также

- **Подробное руководство:** `SERVICE_PATTERNS_GUIDE.md`
- **Шаблон для копирования:** `_TEMPLATE_Example/`

